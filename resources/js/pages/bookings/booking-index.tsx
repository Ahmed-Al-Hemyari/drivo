import React from 'react';
import { Head, usePage } from '@inertiajs/react';
import Navbar from '@/components/drivo-components/navbar';
import BookingCard from '@/components/drivo-components/booking-card'; // Adjust path if needed
import { useTrans } from '@/helpers/useTrans';
import { Booking } from '@/types/types';

interface Props {
  bookings: Booking[];
}

const BookingIndex: React.FC<Props> = ({ bookings }) => {
  const { __ } = useTrans();

  return (
    <div className="min-h-screen bg-base-200/50 text-base-content transition-colors duration-300 pb-16">
      <Head title={__('My Bookings')} />

      <div className="max-w-3xl mx-auto px-4 sm:px-6 pt-10">

        {/* Page Heading Section */}
        <div className="mb-6 text-center sm:text-left rtl:sm:text-right">
          <h1 className="text-3xl font-black text-base-content tracking-tight">
            {__('Booking History')}
          </h1>
          <p className="text-sm text-base-content/60 font-medium mt-1">
            {__('Manage your rental requests, active reservations, and status timelines.')}
          </p>
        </div>

        {/* Dynamic Conditional Content Iteration Layer */}
        {bookings && bookings.length > 0 ? (
          <div className="space-y-4">
            {bookings.map((booking) => (
              <BookingCard key={booking.id} booking={booking} />
            ))}
          </div>
        ) : (
          /* Empty State Guard Module */
          <div className="text-center py-16 bg-base-100 border border-base-200 rounded-3xl shadow-xs font-medium text-base-content/40">
            <div className="w-16 h-16 bg-base-200 rounded-2xl flex items-center justify-center mx-auto mb-4 text-base-content/30 shadow-inner">
              <i className="fa-solid fa-rectangle-list text-2xl"></i>
            </div>
            <h3 className="text-lg font-bold text-base-content/70 mb-1">
              {__('No bookings found')}
            </h3>
            <p className="text-sm max-w-xs mx-auto text-base-content/50 leading-relaxed mb-6">
              {__("You haven't requested or reserved any vehicles yet.")}
            </p>
            <a
              href="/cars"
              className="btn bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white font-bold btn-sm rounded-xl px-6 normal-case"
            >
              <i className="fa-solid fa-magnifying-glass text-xs"></i>
              {__('Explore Cars')}
            </a>
          </div>
        )}

      </div>
    </div>
  );
};

export default BookingIndex;
