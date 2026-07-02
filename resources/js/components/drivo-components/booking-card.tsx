import { router, usePage, Link } from '@inertiajs/react';
import React, { useMemo, useState } from 'react';
import { useTrans } from '@/helpers/useTrans';
import type { Booking } from '@/types/types';

interface Props {
  booking: Booking
}

const BookingCard: React.FC<Props> = ({ booking }) => {
  const { __ } = useTrans();
  const locale = (usePage().props.locale as 'en' | 'ar') || 'en';
  const [isProcessing, setIsProcessing] = useState(false);

  const statusKey = useMemo(() => {
    return (booking.booking_status?.name_en || '').toLowerCase();
  }, [booking.booking_status]);

  const canBeCancelled = useMemo(() => {
    return ['pending', 'confirmed'].includes(statusKey);
  }, [statusKey]);

  const carImage = useMemo(() => {
    if (booking.car?.images && booking.car.images.length > 0) {
      return `/storage/${booking.car.images[0]}`;
    }

    return '/images/no-image-car.svg';
  }, [booking.car]);

  const formatDate = (dateString?: string) => {
    if (!dateString) {
return '—';
}

    const d = new Date(dateString);

    return d.toLocaleDateString(locale === 'ar' ? 'ar-SA-u-nu-latn' : 'en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
    });
  };

  const handleCancel = (e: React.FormEvent) => {
    e.preventDefault();

    if (!confirm(__('Are you sure you want to cancel this booking?'))) {
return;
}

    setIsProcessing(true);
    router.post(`/bookings/cancel/${booking.id}`, {}, {
      preserveScroll: true,
      onFinish: () => setIsProcessing(false),
    });
  };

  return (
    <div className="bg-base-100 border border-base-200/60 rounded-2xl p-6 w-full mx-auto my-4 transition-all duration-300 hover:shadow-md">

      {/* Top Header Row: Booking ID & Status Badge */}
      <div className="flex justify-between items-center border-b border-base-200/50 pb-4 mb-5">
        <div className="flex items-center gap-2">
          <span className="text-xs font-bold text-base-content/40 uppercase tracking-wider">{__('Booking')}</span>
          <span className="text-sm font-black text-(--color-primary-color)">#{booking.id}</span>
        </div>
        <span
          className="capitalize py-1 px-3 rounded-full text-[11px] font-bold shadow-xs border border-black/5"
          style={{
            backgroundColor: booking.booking_status?.background_color || 'var(--fallback-b2)',
            color: booking.booking_status?.font_color || 'var(--fallback-bc)',
          }}
        >
          {booking.booking_status?.[`name_${locale}`]}
        </span>
      </div>

      {/* Main Structural Body */}
      <div className="flex flex-col lg:flex-row justify-between gap-6">

        {/* Left Section: Car Info & Dates */}
        <div className="flex gap-4 items-start flex-1">
          <div className="shrink-0 w-24 h-20 sm:w-28 sm:h-24 rounded-xl overflow-hidden bg-base-200 border border-base-200">
            <img
              className="w-full h-full object-cover"
              src={carImage}
              alt={booking.car?.full_name || 'Car'}
              onError={(e) => {
 (e.target as HTMLImageElement).src = '/images/no-image-car.svg';
}}
            />
          </div>

          <div className="space-y-1.5 text-start">
            <h2 className="text-xl font-black text-base-content tracking-tight">
              {booking.car?.full_name}
              <span className="text-base-content/40 text-xs font-medium block sm:inline sm:ms-2">
                ({booking.car?.category?.[`name_${locale}`]})
              </span>
            </h2>

            <div className="text-xs text-base-content/60 font-medium space-y-0.5">
              <p>
                <span className="text-base-content/40 font-normal">{__('From')}:</span> {formatDate(booking.start_date)}
              </p>
              <p>
                <span className="text-base-content/40 font-normal">{__('To')}:</span> {formatDate(booking.end_date)}
              </p>
            </div>

            <div className="pt-1">
              <span className="badge badge-sm bg-base-200 border-none text-base-content/70 font-bold rounded-md px-2 py-2.5">
                {booking.duration} {__('Days')}
              </span>
            </div>
          </div>
        </div>

        {/* Right Section: Compact Clean Invoice Table */}
        <div className="w-full lg:w-72 border-t lg:border-t-0 lg:border-s border-base-200/60 pt-4 lg:pt-0 lg:ps-6 flex flex-col justify-between gap-4">
          <div className="space-y-2 text-sm font-medium text-base-content/70">
            <div className="flex justify-between">
              <span>{__('Amount')}</span>
              <span className="text-base-content font-semibold">${(booking.amount)}</span>
            </div>
            <div className="flex justify-between">
              <span>{__('VAT')}</span>
              <span className="text-base-content font-semibold">${(booking.vat)}</span>
            </div>
            <div className="flex justify-between border-t border-base-200/40 pt-1.5">
              <span>{__('Total Amount With VAT')}</span>
              <span className="text-base-content font-bold">${(booking.total_amount_with_vat)}</span>
            </div>
            <div className="flex justify-between text-success">
              <span>{__('Total Paid')}</span>
              <span className="font-bold">${(booking.total_paid)}</span>
            </div>
            <div className="flex justify-between border-t border-base-200/40 pt-1.5 text-warning font-bold bg-base-200/30 px-2 py-1.5 rounded-lg mt-1">
              <span>{__('Total Remaining')}</span>
              <span className="text-md font-black">${(booking.total_remaining)}</span>
            </div>
          </div>

          {/* Bottom Call-to-Action Buttons */}
          <div className="w-full pt-1">
            {canBeCancelled ? (
              <form onSubmit={handleCancel} className="w-full">
                <button
                  type="submit"
                  disabled={isProcessing}
                  className="btn btn-warning btn-sm border-none text-white font-bold rounded-xl w-full h-9 min-h-0 normal-case transition-all active:scale-98 disabled:opacity-50"
                >
                  {isProcessing ? <span className="loading loading-spinner loading-xs"></span> : __('Cancel')}
                </button>
              </form>
            ) : statusKey === 'completed' && !booking.rated ? (
              <Link
                href={`/bookings/${booking.id}/rate`}
                className="btn bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none btn-sm text-white font-bold rounded-xl w-full h-9 min-h-0 normal-case text-center flex items-center justify-center transition-all active:scale-98"
              >
                <i className="fa-regular fa-star text-xs me-1"></i> {__('Rate')}
              </Link>
            ) : (
              <button
                className="btn btn-sm bg-base-200 text-base-content/30 border-none rounded-xl w-full h-9 min-h-0 normal-case cursor-not-allowed font-bold"
                disabled
              >
                {__('Locked')}
              </button>
            )}
          </div>
        </div>

      </div>
    </div>
  );
};

export default BookingCard;
