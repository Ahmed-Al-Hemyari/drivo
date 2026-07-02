import { useTrans } from '@/helpers/useTrans';
import React from 'react';

const FeaturesSection = () => {
    const { __ } = useTrans();

    // 💡 Keep data arrays clean and isolated outside the render map loop block
    const features = [
        {
            icon: 'safety',
            glyph: 'fa-solid fa-shield-halved', // Fallback fontawesome icon just in case
            title: __("Insurance & Safety"),
            desc: __("Drive with confidence — coverage included.")
        },
        {
            icon: 'eco',
            glyph: 'fa-solid fa-leaf',
            title: __("Eco-Friendly Options"),
            desc: __("Choose hybrid or electric — drive clean, save green.")
        },
        {
            icon: 'mobile',
            glyph: 'fa-solid fa-mobile-screen-button',
            title: __("Mobile Experience"),
            desc: __("Book, manage, and track your rental from anywhere.")
        }
    ];

    return (
        <div className="relative bg-base-200/40 border-t border-base-200 py-20 overflow-hidden transition-colors">
            <div className="max-w-6xl mx-auto px-4 sm:px-6 w-full">

                <ul className="grid grid-cols-1 md:grid-cols-3 gap-8">
                    {features.map((item) => (
                        <li
                            key={item.icon}
                            className="group flex flex-col items-center text-center md:items-start md:text-start p-8 bg-base-100 border border-base-200 rounded-3xl hover:border-base-300 shadow-xs hover:shadow-xl hover:shadow-base-content/5 transition-all duration-300"
                        >
                            {/* 🎨 Modern Premium SVG Icon Container Bubble */}
                            <div className="w-14 h-14 rounded-2xl bg-(--color-primary-color)/10 text-(--color-primary-color) flex items-center justify-center mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 dark:bg-white/5 dark:text-white dark:border dark:border-white/10">
                                <img
                                    className="w-7 h-7 object-contain dark:brightness-110 dark:contrast-125"
                                    src={`/images/${item.icon}.svg`}
                                    alt=""
                                    onError={(e) => {
                                        // Instant fallback to fontawesome class if the local SVG fails to load
                                        (e.target as HTMLElement).style.display = 'none';
                                        const iconFallback = document.createElement('i');
                                        iconFallback.className = `${item.glyph} text-xl`;
                                        (e.target as HTMLElement).parentNode?.appendChild(iconFallback);
                                    }}
                                />
                            </div>

                            {/* Feature Heading Text */}
                            <h2 className="text-xl font-black text-base-content tracking-tight group-hover:text-(--color-primary-color) transition-colors duration-200">
                                {item.title}
                            </h2>

                            {/* Description Text */}
                            <p className="text-base-content/60 text-sm font-semibold leading-relaxed mt-2">
                                {item.desc}
                            </p>
                        </li>
                    ))}
                </ul>

            </div>
        </div>
    );
};

export default FeaturesSection;
