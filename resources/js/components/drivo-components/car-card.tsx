import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import { Car } from '@/types/types';
import { useTrans } from '@/helpers/useTrans';

interface CarCardProps {
  car: Car;
}

const CarCard: React.FC<CarCardProps> = ({ car }) => {
    const locale = (usePage().props.locale as 'en' | 'ar') || 'en';
    const { __ } = useTrans();

    // Safely extract localization names
    const carBrand = car.brand?.[`name_${locale}`] || '';
    const carName = car?.[`name_${locale}`] || '';
    const carCategory = car.category?.[`name_${locale}`] || '';

    return (
        /* Added data-theme="light" to explicitly lock this component to light styles */
        <div
            data-theme="light"
            className="card bg-white shadow-sm hover:shadow-xl transition-shadow duration-300 border border-slate-100 w-full max-w-md mx-auto group/card overflow-hidden"
        >
            {/* Car Image Container */}
            <figure className="relative h-56 overflow-hidden bg-slate-50">
                <img
                    src={car.images ? `/storage/${car.images[0]}` : '/images/no-image-car.svg'}
                    alt={`${carBrand} ${carName}`}
                    className="w-full h-full object-cover transition-transform duration-500 group-hover/card:scale-105"
                />
                {carCategory && (
                    <span className="badge bg-slate-800 text-white border-none absolute top-4 right-4 shadow-sm font-medium tracking-wide">
                        {carCategory}
                    </span>
                )}
                {carCategory && (
                    <span className={`badge ${car.is_available ? 'bg-green-800 text-white' : 'bg-red-800 text-white'} border-none absolute top-4 left-4 shadow-sm font-medium tracking-wide`}>
                        {car.is_available ? __('Available') : __('Unavailable')}
                    </span>
                )}
            </figure>

            {/* Card Content Body */}
            <div className="card-body p-6 gap-5 text-center items-center">
                {/* Title */}
                <div>
                    <h2 className="card-title text-xl font-bold text-slate-800 justify-center group-hover/card:text-(--color-primary-color) transition-colors">
                        {carBrand} {carName}
                    </h2>
                </div>

                {/* Price & Rating Section */}
                <div className="w-full">
                    <RatingAndPrice car={car} __={__} />
                </div>

                {/* CTA Action Button */}
                <div className="card-actions w-full mt-2">
                    <Link
                        className="btn border-none w-full bg-(--color-primary-color) text-white hover:bg-(--color-primary-hover) transition-all duration-200 normal-case text-base shadow-sm"
                        href={`/cars/${car.id}`}
                    >
                        {__("Rent")}
                    </Link>
                </div>
            </div>
        </div>
    );
};

/*
  Sub-component optimized with specific high-contrast light colors (slate/amber)
*/
const RatingAndPrice: React.FC<{ car: Car; __: (key: string) => string }> = ({ car, __ }) => {
    return car.rate ? (
        <div className="flex items-center justify-center gap-2 text-sm">
            <span className="flex items-center gap-1 text-amber-600 font-semibold bg-amber-50 px-2 py-0.5 rounded-md border border-amber-200/60">
                ★ {car.rate}
            </span>
            <span className="text-slate-300">•</span>
            <span className="text-slate-600 font-medium">
                <strong className="text-lg font-bold text-slate-900">${car.daily_price}</strong> / {__("Day")}
            </span>
        </div>
    ) : (
        <div className="flex flex-col items-center gap-1">
            <span className="text-xs italic text-slate-400 font-medium bg-slate-100 px-2 py-0.5 rounded">
                {__('No reviews yet')}
            </span>
            <span className="text-slate-600 font-medium">
                <strong className="text-lg font-bold text-slate-900">${car.daily_price}</strong> / {__("Day")}
            </span>
        </div>
    );
};

export default CarCard;
