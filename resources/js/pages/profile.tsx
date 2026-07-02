import React, { useMemo, useRef, useState } from 'react';
import { Head, useForm, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import { User } from '@/types';

const Profile: React.FC = () => {
  const { __ } = useTrans();
  const user = usePage().props.auth.user as User;
  const fileInputRef = useRef<HTMLInputElement>(null);

  const [deleteAvatarRequested, setDeleteAvatarRequested] = useState(false);

  // Set up the Inertia form state hook initialized with authenticated user data
  const { data, setData, post, processing, errors, recentlySuccessful } = useForm({
    _method: 'PUT', // Spoofs PUT behavior over a native POST request stream
    name: user.name || '',
    email: user.email || '',
    avatar: null as File | null,
    delete_avatar: false,
  });

  const userAvatarPreview = useMemo(() => {
    if (data.avatar) {
      return URL.createObjectURL(data.avatar);
    }
    if (user.avatar && !deleteAvatarRequested) {
      return `/storage/${user.avatar}`;
    }
    return '/images/no-image-user.webp';
  }, [user.avatar, data.avatar, deleteAvatarRequested]);

  const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const files = e.target.files;
    if (files && files[0]) {
      setDeleteAvatarRequested(false);
      setData((oldData) => ({
        ...oldData,
        avatar: files[0],
        delete_avatar: false
      }));
    }
  };

  const handleDeleteAvatar = () => {
    setDeleteAvatarRequested(true);
    if (fileInputRef.current) fileInputRef.current.value = '';
    setData((oldData) => ({
      ...oldData,
      avatar: null,
      delete_avatar: true
    }));
  };

  const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();

        // Submit via POST to trick PHP/Laravel into parsing the multipart file binary stream
        post('/profile/update', {
            forceFormData: true, // Forces multipart/form-data encoding
            preserveScroll: true,
            onSuccess: () => {
            setData('avatar', null);
            setDeleteAvatarRequested(false);
            }
        });
    };

  return (
    <div className="min-h-screen bg-base-200/50 text-base-content transition-colors duration-300 pb-16">
      <Head title={__('My Profile')} />

      <div className="max-w-3xl mx-auto px-4 sm:px-6 pt-10">

        <div className="mb-8 text-center sm:text-left rtl:sm:text-right">
          <h1 className="text-3xl font-black text-base-content tracking-tight">
            {__('Account Settings')}
          </h1>
          <p className="text-sm text-base-content/60 font-medium mt-1">
            {__('Manage your personal documentation information and contact details.')}
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">

          {/* Left Column: Avatar Display Card */}
          <div className="bg-base-100 border border-base-200 p-6 rounded-3xl shadow-xs flex flex-col items-center justify-center text-center h-fit">

            <input
              type="file"
              ref={fileInputRef}
              onChange={handleFileChange}
              accept="image/*"
              className="hidden"
            />

            <div className="relative group avatar mb-4 cursor-pointer" onClick={() => fileInputRef.current?.click()}>
              <div className="w-24 h-24 rounded-full ring-4 ring-(--color-primary-color)/20 relative bg-base-200 overflow-hidden transition-all duration-300 group-hover:ring-primary/40">
                <img
                  src={userAvatarPreview}
                  alt={user.name}
                  className="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105"
                  onError={(e) => { (e.target as HTMLImageElement).src = '/images/no-image-user.webp'; }}
                />
                <div className="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                  <i className="fa-solid fa-camera text-white text-lg"></i>
                </div>
              </div>
            </div>

            <h2 className="text-lg font-black text-base-content">{user.name}</h2>
            <p className="text-xs text-base-content/50 font-semibold mt-0.5">{user.email}</p>

            <div className="flex items-center gap-2 mt-4 w-full justify-center">
              <button
                type="button"
                onClick={() => fileInputRef.current?.click()}
                className="btn btn-xs bg-base-200 hover:bg-base-300 border-none rounded-lg font-bold text-[11px] px-2.5 py-1 text-base-content normal-case"
              >
                <i className="fa-solid fa-pen text-[10px]"></i>
                {__('Change')}
              </button>

              {((user.avatar && !deleteAvatarRequested) || data.avatar) && (
                <button
                  type="button"
                  onClick={handleDeleteAvatar}
                  className="btn btn-xs bg-error/10 hover:bg-error/20 border-none rounded-lg font-bold text-[11px] px-2.5 py-1 text-error normal-case"
                >
                  <i className="fa-regular fa-trash-can text-[10px]"></i>
                  {__('Remove')}
                </button>
              )}
            </div>

            {errors.avatar && (
              <span className="text-error text-xs mt-2 font-medium max-w-full block truncate">{errors.avatar}</span>
            )}

            {(() => {
              switch (user.role_id) {
                case 1:
                  return (
                    <div className="badge badge-neutral mt-5 font-bold border-none bg-base-200 text-base-content/70 py-3 px-4 rounded-xl text-xs">
                      {__('System Account')}
                    </div>
                  );
                case 2:
                  return (
                    <div className="badge badge-neutral mt-5 font-bold border-none bg-base-200 text-base-content/70 py-3 px-4 rounded-xl text-xs">
                      {__('Admin Account')}
                    </div>
                  );
                default:
                  return (
                    <div className="badge badge-neutral mt-5 font-bold border-none bg-base-200 text-base-content/70 py-3 px-4 rounded-xl text-xs">
                      {__('Customer Account')}
                    </div>
                  );
              }
            })()}
          </div>

          {/* Right Column: Form */}
          <div className="md:col-span-2 bg-base-100 border border-base-200 p-6 sm:p-8 rounded-3xl shadow-xs">
            <form onSubmit={handleSubmit} className="space-y-5">

              <div className="form-control w-full">
                <label className="label font-bold text-xs text-base-content/70 uppercase tracking-wider">
                  {__('Full Name')}
                </label>
                <input
                  type="text"
                  value={data.name}
                  onChange={(e) => setData('name', e.target.value)}
                  className={`input input-bordered w-full rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-sm font-semibold ${
                    errors.name ? 'input-error' : ''
                  }`}
                  required
                />
                {errors.name && (
                  <span className="text-error text-xs mt-1 font-medium">{errors.name}</span>
                )}
              </div>

              <div className="form-control w-full">
                <label className="label font-bold text-xs text-base-content/70 uppercase tracking-wider">
                  {__('Email Address')}
                </label>
                <input
                  type="email"
                  value={data.email}
                  onChange={(e) => setData('email', e.target.value)}
                  className={`input input-bordered w-full rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-sm font-semibold ${
                    errors.email ? 'input-error' : ''
                  }`}
                  placeholder={__('Email Address')}
                  required
                />
                {errors.email && (
                  <span className="text-error text-xs mt-1 font-medium">{errors.email}</span>
                )}
              </div>

              <div className="flex items-center justify-between border-t border-base-200 pt-5 mt-6">
                <div>
                  {recentlySuccessful && (
                    <span className="text-success text-xs font-bold flex items-center gap-1.5 animate-out fade-out duration-1000 delay-2000">
                      <i className="fa-solid fa-circle-check"></i>
                      {__('Saved successfully!')}
                    </span>
                  )}
                </div>

                <button
                  type="submit"
                  disabled={processing}
                  className="btn bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white font-bold rounded-xl px-6 py-2.5 shadow-md normal-case transition-all active:scale-98 disabled:opacity-50 min-w-[120px]"
                >
                  {processing ? (
                    <span className="loading loading-spinner loading-xs"></span>
                  ) : (
                    <>
                      <i className="fa-solid fa-floppy-disk text-xs"></i>
                      {__('Save Changes')}
                    </>
                  )}
                </button>
              </div>

            </form>
          </div>

        </div>

      </div>
    </div>
  );
};

export default Profile;
