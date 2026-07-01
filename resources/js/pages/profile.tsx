import React, { useMemo } from 'react';
import { Head, useForm, usePage } from '@inertiajs/react';
import Navbar from '@/components/drivo-components/navbar';
import { useTrans } from '@/helpers/useTrans';
import { User } from '@/types';

const Profile: React.FC = () => {
  const { __ } = useTrans();
  const user = usePage().props.auth.user as User;

  // Set up the Inertia form state hook initialized with authenticated user data
  const { data, setData, put, processing, errors, recentlySuccessful } = useForm({
    name: user.name || '',
    email: user.email || '',
    phone_number: user.phone_number || '',
  });

  // Handle user avatar rendering securely
  const userAvatar = useMemo(() => {
    if (user.avatar) {
      return `/storage/${user.avatar}`;
    }
    return '/images/no-image-user.webp';
  }, [user.avatar]);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    // Assuming your profile update route points to a PUT endpoint
    put('/profile/update');
  };

  return (
    <div className="min-h-screen bg-base-200/50 text-base-content transition-colors duration-300 pb-16">
      <Head title={__('My Profile')} />

      <Navbar elements={['Home', 'Cars', 'About']} />

      <div className="max-w-3xl mx-auto px-4 sm:px-6 mt-10">

        {/* Page Header */}
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
            <div className="avatar mb-4">
              <div className="w-24 h-24 rounded-full ring-4 ring-(--color-primary-color)/20 relative bg-base-200">
                <img
                  src={userAvatar}
                  alt={user.name}
                  onError={(e) => { (e.target as HTMLImageElement).src = '/images/no-image-user.webp'; }}
                />
              </div>
            </div>
            <h2 className="text-lg font-black text-base-content">{user.name}</h2>
            <p className="text-xs text-base-content/50 font-semibold mt-0.5">{user.email}</p>

            {(() => {
                switch (user.role_id) {
                    case 1:
                    return (
                        <div className="badge badge-neutral mt-4 font-bold border-none bg-base-200 text-base-content/70 py-3 px-4 rounded-xl text-xs">
                        {__('System Account')}
                        </div>
                    );
                    case 2:
                    return (
                        <div className="badge badge-neutral mt-4 font-bold border-none bg-base-200 text-base-content/70 py-3 px-4 rounded-xl text-xs">
                        {__('Admin Account')}
                        </div>
                    );
                    default:
                    return (
                        <div className="badge badge-neutral mt-4 font-bold border-none bg-base-200 text-base-content/70 py-3 px-4 rounded-xl text-xs">
                        {__('Customer Account')}
                        </div>
                    );
                }
            })()}
          </div>

          {/* Right Column: Information Configuration Form */}
          <div className="md:col-span-2 bg-base-100 border border-base-200 p-6 sm:p-8 rounded-3xl shadow-xs">
            <form onSubmit={handleSubmit} className="space-y-5">

              {/* Name input */}
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

              {/* Email Input */}
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

              {/* Phone Input */}
              <div className="form-control w-full">
                <label className="label font-bold text-xs text-base-content/70 uppercase tracking-wider">
                  {__('Phone Number')}
                </label>
                <input
                  type="text"
                  value={data.phone_number}
                  onChange={(e) => setData('phone_number', e.target.value)}
                  placeholder={__('Phone Number')}
                  className={`input input-bordered w-full rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-sm font-semibold text-left rtl:text-right ${
                    errors.phone_number ? 'input-error' : ''
                  }`}
                />
                {errors.phone_number && (
                  <span className="text-error text-xs mt-1 font-medium">{errors.phone_number}</span>
                )}
              </div>

              {/* Submit Actions Area */}
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
