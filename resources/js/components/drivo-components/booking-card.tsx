import React, { useState } from 'react';
import { router, Link } from '@inertiajs/react';
import noImage from '/public/images/no-image-car.svg';
import { Booking } from '@/types/types';

interface BookingCardProps {
  booking: Booking;
}

const BookingCard: React.FC<BookingCardProps> = ({ booking }) => {
  const [isProcessing, setIsProcessing] = useState<boolean>(false);

  // Replaces Vue computed property 'canBeCancelled'
  const canBeCancelled = ['pending', 'confirmed'].includes(booking.booking_status?.name_en ?? "");

  // Dynamic status design classes dictionary maps (replaces Vue switch computed)
  const getStatusClasses = (status: string): string => {
    const base = 'capitalize py-1 px-3 rounded-full text-sm font-medium';

    const statusMap: Record<string, string> = {
      pending: 'bg-yellow-100 text-yellow-700',
      confirmed: 'bg-blue-100 text-blue-700',
      cancelled: 'bg-red-100 text-red-700',
      refused: 'bg-rose-100 text-rose-700',
      active: 'bg-green-100 text-green-700',
      expired: 'bg-gray-100 text-gray-700',
      late: 'bg-orange-100 text-orange-700',
    };

    return `${base} ${statusMap[status] || 'bg-gray-100 text-gray-700'}`;
  };

  // Date formatter helper function
  const formatDate = (dateString: string): string => {
    if (!dateString) return '—';
    const d = new Date(dateString);
    return d.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'short',
      day: 'numeric',
    });
  };

  // Cancel form submit handler
  const handleCancel = (e: React.FormEvent) => {
    e.preventDefault();
    if (!window.confirm('Are you sure you want to cancel this booking?')) return;
    setIsProcessing(true);

    router.post(
      `/bookings/cancel/${booking.id}`,
      {},
      {
        preserveScroll: true,
        onFinish: () => setIsProcessing(false),
        onError: () => alert('Failed to cancel booking. Please try again.'),
      }
    );
  };

  return (
    <div className="flex flex-col md:flex-row justify-between bg-white border border-gray-200 hover:shadow-lg transition rounded-2xl p-4 w-full mx-auto my-3">
      {/* Booking Info */}
      <div className="flex flex-col md:flex-row items-center w-full">
        {/* Car Image */}
        <div className="flex-shrink-0">
          <img
            className="mx-auto md:mr-4 w-32 h-24 object-cover rounded-xl border border-gray-200 bg-gray-50"
            src={booking.car?.images ? `/storage/${booking.car?.images[0]}` : noImage}
            alt="Car"
          />
        </div>

        {/* Booking Details */}
        <div className="flex flex-col justify-between w-full md:w-auto mt-4 md:mt-0 text-center md:text-left space-y-3">
          <h1 className="text-lg font-semibold text-gray-700">
            Booking <span className="text-blue-600">#{booking.id}</span>
          </h1>

          <h2 className="text-2xl font-bold text-gray-800">
            {booking.car?.brand?.name_en} {booking.car?.name_en}{' '}
            <span className="text-gray-500 text-sm font-normal">
              ({booking.car?.category?.name_en})
            </span>
          </h2>

          <p className={getStatusClasses(booking.booking_status?.name_en ?? '')}>
            {booking.booking_status?.name_en}
          </p>

          <p className="text-sm text-gray-600">
            <span className="font-medium text-gray-700">From:</span>{' '}
            {formatDate(booking.start_date)}
            <span className="mx-1 text-gray-400"> – </span>
            <span className="font-medium text-gray-700">To:</span>{' '}
            {formatDate(booking.end_date)}
          </p>
        </div>
      </div>

      {/* Actions (Replaces sequential v-if / v-else-if / v-else conditionals) */}
      <div className="flex flex-row md:flex-col items-center justify-center space-x-2 md:space-x-0 md:space-y-3 mt-5 md:mt-0">
        {canBeCancelled ? (
          <form onSubmit={handleCancel}>
            <button
              type="submit"
              disabled={isProcessing}
              className="px-5 py-2 text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-300 transition disabled:opacity-50"
            >
              Cancel
            </button>
          </form>
        ) : booking.booking_status?.name_en === 'completed' && booking.rated === false ? (
          <Link
            href={`/rates/${booking.id}`}
            className="px-5 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 transition"
          >
            Rate
          </Link>
        ) : (
          <form onSubmit={(e) => e.preventDefault()}>
            <button
              className="px-5 py-2 text-sm font-medium text-white bg-gray-400 rounded-lg cursor-not-allowed"
              disabled
            >
              Cancel
            </button>
          </form>
        )}
      </div>
    </div>
  );
};

export default BookingCard;
