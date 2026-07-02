import React, { useMemo, useState } from 'react';
import { router, usePage, Link } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import { Booking } from '@/types/types';

interface Props {
  booking: Booking;
}

const BookingCard: React.FC<Props> = ({ booking }) => {
  const { __ } = useTrans();
  const locale = (usePage().props.locale as 'en' | 'ar') || 'en';
  const [isProcessing, setIsProcessing] = useState(false);

  // Isolate current English state key for conditional capability checking
  const statusKey = useMemo(() => {
    return (booking.booking_status?.name_en || '').toLowerCase();
  }, [booking.booking_status]);

  // Determine if a booking can be cancelled
  const canBeCancelled = useMemo(() => {
    return ['pending', 'confirmed'].includes(statusKey);
  }, [statusKey]);

  // Handle image mapping securely
  const carImage = useMemo(() => {
    if (booking.car?.images && booking.car.images.length > 0) {
      return `/storage/${booking.car.images[0]}`;
    }
    return '/images/no-image-car.svg';
  }, [booking.car?.images]);

  // Format localized dates nicely
  const formatDate = (dateString?: string) => {
    if (!dateString) return '—';
    const d = new Date(dateString);
    return d.toLocaleDateString(locale === 'ar' ? 'ar-SA-u-nu-latn' : 'en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
    });
  };

  // Cancel processing logic
  const handleCancel = (e: React.FormEvent) => {
    e.preventDefault();
    if (!confirm(__('Are you sure you want to cancel this booking?'))) return;

    setIsProcessing(true);
    router.post(`/bookings/cancel/${booking.id}`, {}, {
      preserveScroll: true,
      onFinish: () => setIsProcessing(false),
    });
  };
  console.log(statusKey);
  console.log(!booking.rated);
  return (
    <div className="flex flex-col md:flex-row justify-between bg-base-100 border border-base-200 hover:shadow-md transition-all duration-300 rounded-2xl p-4 w-full mx-auto my-3 gap-4">

      {/* Left Segment: Car Graphics and Detailed Booking Specs */}
      <div className="flex flex-col sm:flex-row items-center w-full gap-4">

        {/* Car Image Thumbnail Block */}
        <div className="shrink-0 relative w-32 h-24 rounded-xl overflow-hidden bg-base-200 border border-base-200">
          <img
            className="w-full h-full object-cover"
            src={carImage}
            alt={booking.car?.full_name || 'Car'}
            onError={(e) => { (e.target as HTMLImageElement).src = '/images/no-image-car.svg'; }}
          />
        </div>

        {/* Core Metadata Specifications Output */}
        <div className="flex flex-col justify-between text-center sm:text-left rtl:sm:text-right space-y-2 w-full sm:w-auto">
          <h1 className="text-md font-bold text-base-content/60">
            {__('Booking')} <span className="text-(--color-primary-color)">#{booking.id}</span>
          </h1>

          <h2 className="text-xl font-black text-base-content">
                {booking.car?.full_name}{' '}
            <span className="text-base-content/50 text-xs font-medium block sm:inline">
              ({booking.car?.category?.[`name_${locale}`]})
            </span>
          </h2>

          {/* Dynamic Status Capsule fueled by DB Columns */}
          <div>
            <span
              className="inline-block capitalize py-0.5 px-3 rounded-full text-xs font-bold shadow-xs border border-black/5"
              style={{
                backgroundColor: booking.booking_status?.background_color || 'var(--fallback-b2)',
                color: booking.booking_status?.font_color || 'var(--fallback-bc)',
              }}
            >
              {booking.booking_status?.[`name_${locale}`]}
            </span>
          </div>

          <p className="text-xs text-base-content/70 font-semibold">
            <span className="text-base-content/40 font-medium">{__('From')}:</span> {formatDate(booking.start_date)}{' '}
            <span className="mx-1 text-base-content/30">–</span>{' '}
            <span className="text-base-content/40 font-medium">{__('To')}:</span> {formatDate(booking.end_date)}
          </p>
        </div>
      </div>

      {/* Right Segment: Context-Driven Execution Actions Layout */}
      <div className="flex sm:flex-row md:flex-col items-center justify-center gap-2 shrink-0 border-t border-base-200 pt-3 md:pt-0 md:border-t-0">
        {canBeCancelled ? (
          <form onSubmit={handleCancel} className="w-full sm:w-auto">
            <button
              type="submit"
              disabled={isProcessing}
              className="btn btn-warning btn-sm text-white font-bold rounded-xl px-5 normal-case w-full transition-all active:scale-98 disabled:opacity-50"
            >
              {isProcessing ? <span className="loading loading-spinner loading-xs"></span> : __('Cancel')}
            </button>
          </form>
        ) : statusKey == 'completed' && !booking.rated? (
          <Link
            href={`/bookings/${booking.id}/rate`}
            className="btn bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none btn-sm text-white font-bold rounded-xl px-5 normal-case w-full sm:w-auto transition-all active:scale-98"
          >
            {__('Rate')}
          </Link>
        ) : (
          <button
            className="btn btn-sm bg-base-300 text-base-content/40 border-none rounded-xl px-5 normal-case cursor-not-allowed w-full sm:w-auto"
            disabled
          >
            {__('Cancel')}
          </button>
        )}
      </div>

    </div>
  );
};

export default BookingCard;
