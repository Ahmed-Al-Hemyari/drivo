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

    const carBrand = car.brand?.[`name_${locale}`] || '';
    const carName = car?.[`name_${locale}`] || '';
    const carCategory = car.category?.[`name_${locale}`] || '';

    return (
        <Link href={`/cars/${car.id}`}>
            <div className="card bg-base-100 shadow-sm hover:shadow-xl transition-all duration-300 border border-base-200 w-full max-w-md mx-auto group/card overflow-hidden">
                {/* Image Wrapper */}
                <figure className="relative h-56 overflow-hidden bg-base-200">
                    <img
                        src={car.images ? `/storage/${car.images[0]}` : '/images/no-image-car.svg'}
                        alt={`${carBrand} ${carName}`}
                        className="w-full h-full object-cover transition-transform duration-500 group-hover/card:scale-105"
                    />
                    {carCategory && (
                        <span className="badge bg-slate-900 px-1 text-white border-none absolute top-4 right-4 shadow-sm font-medium">
                            {carCategory}
                        </span>
                    )}
                    <span className={`badge ${car.is_available ? 'bg-emerald-700 text-white' : 'bg-rose-700 text-white'} px-1 border-none absolute top-4 left-4 shadow-sm font-medium`}>
                        {car.is_available ? __('Available') : __('Unavailable')}
                    </span>
                </figure>

                {/* Content Body */}
                <div className="card-body p-6 gap-5 text-center items-center">
                    <div>
                        <h2 className="card-title text-xl font-bold text-base-content justify-center group-hover/card:text-(--color-primary-color) transition-colors">
                            {car.full_name}
                        </h2>
                    </div>

                    <div className="w-full">
                        <RatingAndPrice car={car} __={__} />
                    </div>

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
        </Link>
    );
};

const RatingAndPrice: React.FC<{ car: Car; __: (key: string) => string }> = ({ car, __ }) => {
    return car.rate ? (
        <div className="flex items-center justify-center gap-2 text-sm">
            <span className="flex items-center gap-1 text-amber-500 font-semibold bg-amber-500/10 px-2 py-0.5 rounded-md border border-amber-500/20">
                ★ {car.rate}
            </span>
            <span className="text-base-content/30">•</span>
            <span className="text-base-content/70 font-medium">
                <strong className="text-lg font-bold text-base-content">${car.daily_price}</strong> / {__("Day")}
            </span>
        </div>
    ) : (
        <div className="flex flex-col items-center gap-1">
            <span className="text-xs italic text-base-content/50 font-medium bg-base-200 px-2 py-0.5 rounded">
                {__('No reviews yet')}
            </span>
            <span className="text-base-content/70 font-medium">
                <strong className="text-lg font-bold text-base-content">${car.daily_price}</strong> / {__("Day")}
            </span>
        </div>
    );
};

export default CarCard;
