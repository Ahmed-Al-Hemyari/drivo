import { Link, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import { Brand } from '@/types/types';

interface BrandsProps {
    brands: Brand[];
}

export default function BrandsSection({ brands }: BrandsProps) {
    const { __ } = useTrans();
    const locale = (usePage().props.locale as 'en' | 'ar') || 'en';

    return (
        <section className="py-16 border-t border-base-200/60 bg-base-100">
            <div className="max-w-6xl mx-auto px-4 sm:px-6">

                {/* Section Header */}
                <div className="mb-8 text-center">
                    <h2 className="text-2xl sm:text-3xl font-black tracking-tight text-base-content">
                        {__('Top Brands Available')}
                    </h2>
                    <p className="text-sm font-medium text-base-content/50 mt-1">
                        {__('Drive absolute quality from trusted global engineering fleets')}
                    </p>
                </div>

                {/* Responsive Flex Grid Flow Container */}
                <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    {brands.map((brand) => (
                        <Link
                            key={brand.id}
                            href={`/cars?brand=${brand.id}`}
                            className="group relative flex flex-col items-center justify-center h-32 p-4 bg-base-100 border border-base-200/80 hover:border-base-300 rounded-3xl transition-all duration-300 hover:shadow-md active:scale-95 overflow-hidden"
                        >
                            {/* 🌟 Cleaned Up Logo Wrapper with Dark Mode Backdrop Guard */}
                            <div className="h-14 w-full max-w-[100px] flex items-center justify-center p-2 rounded-xl dark:bg-white/90 dark:backdrop-blur-xs opacity-75 group-hover:opacity-100 grayscale group-hover:grayscale-0 contrast-125 transition-all duration-300 group-hover:scale-105">
                                <img
                                    src={brand.logo ? `/storage/${brand.logo}` : '/images/no-image-car.svg'}
                                    alt={brand[`name_${locale}`]}
                                    className="w-full h-full object-contain"
                                    onError={(e) => {
                                        (e.target as HTMLImageElement).src = '/images/no-image-car.svg';
                                    }}
                                />
                            </div>

                            {/* 📝 Cleaned Up Label Text */}
                            <span className="mt-3 text-xs font-extrabold tracking-wide uppercase text-base-content/40 group-hover:text-(--color-primary-color) transition-colors truncate max-w-full">
                                {brand[`name_${locale}`]}
                            </span>
                        </Link>
                    ))}
                </div>

            </div>
        </section>
    );
}
