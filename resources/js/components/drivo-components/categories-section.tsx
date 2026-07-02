import { Link, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import type { Category } from '@/types/types';

interface CategoriesProps {
    categories: Category[];
}

export default function CategoriesSection({ categories }: CategoriesProps) {
    const { __ } = useTrans();
    const locale = (usePage().props.locale as 'en' | 'ar') || 'en';

    return (
        // 🎨 Tinted section wrapper
        <section className="py-16 border-t border-base-200/60 bg-base-200/40">
            <div className="max-w-6xl mx-auto px-4 sm:px-6">

                {/* Header Title Grid */}
                <div className="mb-10 text-center">
                    <h2 className="text-2xl sm:text-3xl font-black tracking-tight text-base-content">
                        {__('Browse by Category')}
                    </h2>
                    <p className="text-sm font-medium text-base-content/50 mt-1">
                        {__('Find the perfect ride tailored to your specific journey needs')}
                    </p>
                </div>

                {/* Modern Flex Grid Container */}
                <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    {categories.map((category) => (
                        <Link
                            key={category.id}
                            href={`/cars?category=${category.id}`}
                            // 🌟 Cards are now bg-base-100 to float cleanly over the tinted container layout
                            className="group flex flex-col items-center justify-center p-6 bg-base-100 border border-base-200/80 hover:border-base-300 rounded-3xl transition-all duration-300 hover:shadow-xl hover:shadow-base-content/5 active:scale-95 text-center"
                        >
                            {/* Icon frame adapts gracefully to dark backgrounds */}
                            <div className="w-14 h-14 bg-base-200/60 dark:bg-zinc-300 rounded-2xl p-2 border border-base-200/80 flex items-center justify-center text-xl text-base-content/70 group-hover:bg-(--color-primary-color) group-hover:text-white group-hover:border-transparent transition-all duration-300 group-hover:scale-105 group-hover:rotate-3">
                                <img
                                    src={category.icon ? `/storage/${category.icon}` : '/images/no-image-car.svg'}
                                    alt={category[`name_${locale}`]}
                                    className="w-full h-full object-contain"
                                    onError={(e) => {
                                        (e.target as HTMLImageElement).src = '/images/no-image-car.svg';
                                    }}
                                />
                            </div>

                            <span className="mt-4 font-bold text-sm text-base-content/70 group-hover:text-base-content transition-colors truncate w-full px-1">
                                {category[`name_${locale}`]}
                            </span>
                        </Link>
                    ))}
                </div>

            </div>
        </section>
    );
}
