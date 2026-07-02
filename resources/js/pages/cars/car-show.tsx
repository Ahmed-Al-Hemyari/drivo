import { Link, Head, usePage } from '@inertiajs/react';
import React, { useMemo, useState } from 'react';
import Calendar from 'react-calendar';
import { useTrans } from '@/helpers/useTrans';
import 'react-calendar/dist/Calendar.css';
import type { Car } from '@/types/types';

interface Props {
  car: Car;
}

const CarShow: React.FC<Props> = ({ car }) => {
  const { __ } = useTrans();
  const locale = (usePage().props.locale as 'en' | 'ar') || 'en';

  // 1. Image Fix Logic: Parse multi-images array. If missing/empty, fall back to our placeholder vector asset
  const carImages = useMemo(() => {
    if (car.images && car.images.length > 0) {
      return car.images.map(img => `/storage/${img}`);
    }

    return ['/images/no-image-car.svg'];
  }, [car.images]);

  // Track the active selected view photo for our gallery viewer
  const [activeImageIndex, setActiveImageIndex] = useState(0);

  // Parse unavailable dates safely for the calendar interface tile styling
  const bookedDates = useMemo(() => {
    return new Set(car.unavailable_dates || []);
  }, [car.unavailable_dates]);

  // Calendar class modifiers to highlight booked slots
  const tileClassName = ({ date }: { date: Date }) => {
    // Correct timezone offsetting conversion to isolate local date string matching YYYY-MM-DD format
    const offset = date.getTimezoneOffset();
    const localDate = new Date(date.getTime() - (offset * 60 * 1000));
    const dateString = localDate.toISOString().split('T')[0];

    if (bookedDates.has(dateString)) {
      return 'booked-date-tile';
    }

    return null;
  };

  return (
    <div className="min-h-screen bg-base-200/50 text-base-content transition-colors duration-300 pb-16">
      <Head title={`${car.full_name}`} />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 pt-8">

        {/* Back Button Link */}
        <Link
          href="/cars"
          className="inline-flex items-center text-sm font-semibold text-base-content/70 hover:text-(--color-primary-color) transition-colors mb-6 group"
        >
          <i className="fa-solid fa-arrow-left me-2 transition-transform group-hover:-translate-x-1 rtl:group-hover:translate-x-1 rtl:rotate-180"></i>
          {__('Back to Cars')}
        </Link>

        {/* 🎨 Main Split Grid Container */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 bg-base-100 border border-base-200 p-4 sm:p-8 rounded-3xl shadow-xs mb-10">

          {/* Left Column: Premium Multi-Image Interactive Gallery Frame */}
          <div className="flex flex-col gap-4">
            <div className="relative w-full aspect-4/3 rounded-2xl overflow-hidden bg-base-200 border border-base-300 shadow-sm group">
              <img
                src={carImages[activeImageIndex]}
                alt={car.full_name}
                className="w-full h-full object-cover transition-all duration-300"
                onError={(e) => {
                  // Instant native broken asset recovery fallback guard
                  (e.target as HTMLImageElement).src = '/images/no-image-car.svg';
                }}
              />
              {car.rate ? (
                <span className="absolute top-4 start-4 badge badge-lg bg-base-100/90 backdrop-blur-md text-yellow-500 font-bold border-none shadow-xs gap-1.5 py-4 px-2">
                    <i className="fa-solid fa-star text-sm"></i> {[`★ ${car.rate}`]}
                </span>
              ): (
                ''
              )}
            </div>

            {/* Thumbnail Selectors (Only rendered if multiple images are present) */}
            {carImages.length > 1 && (
              <div className="flex gap-2 overflow-x-auto pb-1 scrollbar-thin">
                {carImages.map((image, idx) => (
                  <button
                    key={idx}
                    onClick={() => setActiveImageIndex(idx)}
                    className={`relative w-20 aspect-4/3 rounded-xl overflow-hidden border-2 bg-base-200 shrink-0 transition-all ${
                      activeImageIndex === idx ? 'border-(--color-primary-color) scale-95 shadow-xs' : 'border-transparent opacity-70 hover:opacity-100'
                    }`}
                  >
                    <img src={image} className="w-full h-full object-cover" alt="" />
                  </button>
                ))}
              </div>
            )}
          </div>

          {/* Right Column: Descriptions and Enhanced Calendar Integration */}
          <div className="flex flex-col justify-between gap-8">
            <div>
              <span className="text-xs uppercase tracking-wider font-bold text-(--color-primary-color) bg-(--color-primary-color)/10 px-3 py-1 rounded-full">
                {car.category?.[`name_${locale}`]}
              </span>
              <h1 className="text-3xl sm:text-4xl font-black text-base-content mt-3 mb-2">
                {car.full_name}
              </h1>

              <div className="flex items-baseline gap-1 mt-4">
                <span className="text-3xl font-black text-base-content">
                  ${car.daily_price}
                </span>
                <span className="text-sm text-base-content/60 font-medium">
                  / {__('Day')}
                </span>
              </div>

              <div className="mt-6">
                <Link
                  href={`/bookings/add/${car.id}`}
                  className="btn bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white font-bold px-8 rounded-xl shadow-md transition-all active:scale-98 normal-case w-full sm:w-auto"
                >
                  <i className="fa-solid fa-car-side"></i>
                  {__('Book Now')}
                </Link>
              </div>
            </div>

            {/* Availability Enhanced Calendar Integration Layer */}
            <div className="border-t border-base-200 pt-6">
              <h2 className="text-lg font-bold mb-4 flex items-center gap-2">
                <i className="fa-regular fa-calendar text-base-content/60"></i>
                {__('Availability')}
              </h2>
              <div className="p-4 bg-base-200/40 rounded-2xl border border-base-200/70 shadow-xs overflow-hidden custom-drivo-calendar">
                <Calendar
                    tileClassName={tileClassName}
                    locale={locale === 'ar' ? 'ar-SA-u-nu-latn' : 'en-US'}
                    next2Label={null}
                    prev2Label={null}
                />
              </div>
            </div>

          </div>
        </div>

        {/* 🎨 Reviews Section */}
        <div className="bg-base-100 border border-base-200 rounded-3xl p-6 sm:p-8 shadow-xs">
          <h2 className="text-2xl font-black mb-6 flex items-center gap-3">
            <span>{__('Reviews')}</span>
            <span className="badge badge-neutral badge-md rounded-lg font-semibold bg-base-200 text-base-content border-none">
              {car.reviews?.length || 0}
            </span>
          </h2>

          {car.reviews && car.reviews.length > 0 ? (
            <div className="space-y-4">
              {car.reviews.map((review) => (
                <div
                  key={review.id}
                  className="p-4 rounded-2xl bg-base-200/40 border border-base-200/70 flex gap-4 items-start transition-all hover:bg-base-200/80"
                >
                  <div className="avatar shrink-0">
                    <div className="w-12 h-12 rounded-full ring-2 ring-base-content/10">
                      <img
                        src={review.user?.avatar ? `/storage/${review.user.avatar}` : '/images/no-image-user.webp'}
                        alt={review.user?.name}
                        onError={(e) => {
 (e.target as HTMLImageElement).src = '/images/no-image-user.webp';
}}
                      />
                    </div>
                  </div>

                  <div className="flex-1 min-w-0">
                    <div className="flex justify-between items-center mb-1 gap-2">
                      <h3 className="font-bold text-base text-base-content truncate">
                        {review.user?.name ?? __('User')}
                      </h3>
                      <span className="flex items-center gap-1 text-sm font-bold text-yellow-500 shrink-0">
                        ★ {review.rate}
                      </span>
                    </div>
                    <p className="text-sm text-base-content/70 leading-relaxed text-left rtl:text-right">
                      {review.comment ?? '-'}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          ) : (
            <div className="text-center py-12 text-base-content/40 font-medium border-2 border-dashed border-base-200 rounded-2xl">
              <i className="fa-regular fa-comment-dots text-3xl mb-2 block opacity-50"></i>
              <p>{__('No reviews yet')}</p>
            </div>
          )}
        </div>

      </div>
    </div>
  );
};

export default CarShow;
