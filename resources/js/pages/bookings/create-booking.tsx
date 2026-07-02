import { Link, Head, useForm, usePage } from '@inertiajs/react';
import React, { useMemo } from 'react';
import { useTrans } from '@/helpers/useTrans';
import type { Car } from '@/types/types';

interface Props {
  car: Car;
  vat: number;
}

const CreateBooking: React.FC<Props> = ({ car, vat }) => {
  const { __ } = useTrans();
  const locale = (usePage().props.locale as 'en' | 'ar') || 'en';

  // Initialize the Inertia form context hook
  const { data, setData, post, processing, errors } = useForm({
    start_date: '',
    end_date: '',
    notes: '',
  });

  // Safe fallback image mapping logic
  const carImage = useMemo(() => {
    if (car.images && car.images.length > 0) {
      return `/storage/${car.images[0]}`;
    }

    return '/images/no-image-car.svg';
  }, [car.images]);

  // Compute duration automatically in pure React lifecycle
    const rentalDuration = useMemo(() => {
        if (!data.start_date || !data.end_date) {
    return 0;
    }

    const start = new Date(data.start_date);
    const end = new Date(data.end_date);
    const diffMs = end.getTime() - start.getTime();
    const diffDays = Math.ceil(diffMs / (1000 * 60 * 60 * 24));

    return diffDays > 0 ? diffDays : 0;
  }, [data.start_date, data.end_date]);

    // Compute price total
    const computedTotalAmount = useMemo(() => {
        return rentalDuration * (car?.daily_price || 0);
    }, [rentalDuration, car]);

    const computedVAT = useMemo(() => {
        return vat * computedTotalAmount;
    }, [vat, computedTotalAmount]);

    const computedTotalAmountWithVAT = useMemo(() => {
        return computedTotalAmount + computedVAT;
    }, [computedTotalAmount, computedVAT]);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    post(`/bookings/add/${car.id}`);
  };

  return (
    <div className="min-h-screen bg-base-200/50 text-base-content transition-colors duration-300 pb-16">
      <Head title={`${__('Book')} ${car.full_name}`} />

      <div className="max-w-3xl mx-auto px-4 sm:px-6 pt-8">

        {/* Back Link */}
        <Link
          href="/cars"
          className="inline-flex items-center text-sm font-semibold text-base-content/70 hover:text-(--color-primary-color) transition-colors mb-6 group"
        >
          <i className="fa-solid fa-arrow-left me-2 transition-transform group-hover:-translate-x-1 rtl:group-hover:translate-x-1 rtl:rotate-180"></i>
          {__('Back to Cars')}
        </Link>

        {/* Form Container Wrapper */}
        <div className="bg-base-100 border border-base-200 p-6 sm:p-8 rounded-3xl shadow-xs">

          {/* Header Car Overview Specs Panel */}
          <div className="text-center mb-8 border-b border-base-200 pb-6">
            <div className="relative w-full max-w-md mx-auto aspect-4/3 rounded-2xl overflow-hidden bg-base-200 border border-base-300 shadow-xs">
              <img
                src={carImage}
                alt={car.full_name}
                className="w-full h-full object-cover"
                onError={(e) => {
 (e.target as HTMLImageElement).src = '/images/no-image-car.svg';
}}
              />
            </div>
            <span className="text-xs uppercase tracking-wider font-bold text-(--color-primary-color) bg-(--color-primary-color)/10 px-3 py-1 rounded-full inline-block mt-4">
              {car.category?.[`name_${locale}`]}
            </span>
            <h2 className="text-2xl sm:text-3xl font-black text-base-content mt-2">
              {car.full_name}
            </h2>

            <div className="flex justify-center items-center mt-2 gap-4 text-base font-bold text-base-content/70">
              <span>${car.daily_price} / {__('Day')}</span>
              {car.rate ? (
                <div className='flex flex-row gap-2 items-center'>
                    <span className="text-base-content/30">|</span>
                    <span className="text-yellow-500 flex items-center gap-1">★ {car.rate}</span>
                </div>
              ) : ''}
            </div>
          </div>

          {/* Interactive Core Form Input Layout */}
          <form onSubmit={handleSubmit} className="space-y-6">

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              {/* Pick-Up Component */}
              <div className="form-control">
                <label className="label font-bold text-sm text-base-content/80">
                  {__('Pick-Up Date')}
                </label>
                <input
                  type="date"
                  value={data.start_date}
                  onChange={(e) => setData('start_date', e.target.value)}
                  className={`input input-bordered rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-left rtl:text-right ${
                    errors.start_date ? 'input-error' : ''
                  }`}
                />
                {errors.start_date && (
                  <span className="text-error text-xs mt-1 font-medium">{errors.start_date}</span>
                )}
              </div>

              {/* Return Component */}
              <div className="form-control">
                <label className="label font-bold text-sm text-base-content/80">
                  {__('Return Date')}
                </label>
                <input
                  type="date"
                  value={data.end_date}
                  onChange={(e) => setData('end_date', e.target.value)}
                  className={`input input-bordered rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-left rtl:text-right ${
                    errors.end_date ? 'input-error' : ''
                  }`}
                />
                {errors.end_date && (
                  <span className="text-error text-xs mt-1 font-medium">{errors.end_date}</span>
                )}
              </div>
            </div>

            {/* Injected Invoice Live Calculations Breakdown Section */}
            <div className="bg-base-200/50 border border-base-200 p-4 rounded-2xl space-y-2.5 shadow-inner">
              <h3 className="text-sm uppercase tracking-wider font-bold text-base-content/50 mb-1">
                {__('Rental Summary')}
              </h3>

              <div className="flex justify-between items-center text-sm font-semibold text-base-content/80">
                <span>{__('Duration')}:</span>
                <span className="text-(--color-primary-color) font-bold">
                  {rentalDuration} {__('Days')}
                </span>
              </div>

              <div className="flex justify-between items-center text-base font-bold text-base-content border-t border-base-300 pt-2.5 mt-1">
                <span>{__('Amount')}:</span>
                <span className="text-(--color-primary-color) text-lg font-black">
                  ${computedTotalAmount}
                </span>
              </div>
              <div className="flex justify-between items-center text-base font-bold text-base-content border-t border-base-300 pt-2.5 mt-1">
                <span>{__('VAT')}:</span>
                <span className="text-(--color-primary-color) text-lg font-black">
                  ${computedVAT}
                </span>
              </div>
              <div className="flex justify-between items-center text-base font-bold text-base-content border-t border-base-300 pt-2.5 mt-1">
                <span>{__('Total Amount With VAT')}:</span>
                <span className="text-(--color-primary-color) text-lg font-black">
                  ${computedTotalAmountWithVAT}
                </span>
              </div>
            </div>

            {/* Custom Notes Messaging Textarea Block */}
            <div className="form-control flex flex-col">
              <label className="label font-bold text-sm text-base-content/80">
                {__('Notes')} ({__('Optional')})
              </label>
              <textarea
                value={data.notes}
                onChange={(e) => setData('notes', e.target.value)}
                placeholder={__('Add any custom requests or notes here...')}
                className="textarea textarea-bordered w-full h-28 rounded-xl bg-base-200/50 focus:outline-none focus:border-(--color-primary-color) text-sm leading-relaxed"
              ></textarea>
              {errors.notes && (
                <span className="text-error text-xs mt-1 font-medium">{errors.notes}</span>
              )}
            </div>

            {/* Safe Submission Processing CTA button */}
            <button
              type="submit"
              disabled={processing}
              className="btn bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white font-bold text-base rounded-xl w-full py-3 shadow-md normal-case transition-all active:scale-98 disabled:opacity-50"
            >
              {processing ? (
                <span className="loading loading-spinner loading-sm"></span>
              ) : (
                <>
                  <i className="fa-solid fa-file-invoice-dollar"></i>
                  {__('Confirm Booking')}
                </>
              )}
            </button>

          </form>
        </div>

      </div>
    </div>
  );
};

export default CreateBooking;
