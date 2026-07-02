import React from 'react';
import { Link } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';

const Hero: React.FC = () => {
    const { __ } = useTrans();

    return (
        <section className="relative bg-linear-to-b from-base-200/60 via-base-100/40 to-base-100 py-20 md:py-32 overflow-hidden transition-colors duration-300">
            {/* 🌌 Subtle Background Decorative Radial Blur Glow */}
            <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-(--color-primary-color)/5 dark:bg-(--color-primary-color)/10 rounded-full blur-3xl pointer-events-none" />

            <div className="relative flex flex-col-reverse md:flex-row items-center justify-between max-w-6xl mx-auto px-4 sm:px-6 gap-12 z-10">

                {/* 📝 Left/Right Column: Text Content */}
                <div className="flex flex-col items-center text-center md:items-start md:text-start space-y-6 w-full md:w-1/2">
                    <h1 className="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.15] tracking-tight text-base-content">
                        <span className="text-(--color-primary-color) hover:brightness-110 transition-all">{__("Rent")}</span>
                        <span className="opacity-40">.</span>{' '}
                        <span>{__("Ride")}</span>
                        <span className="opacity-40">.</span>{' '}
                        <span className="text-(--color-primary-color) hover:brightness-110 transition-all">{__("Repeat")}</span>
                        <span className="text-(--color-primary-color)">.</span>
                    </h1>

                    <p className="text-base sm:text-lg lg:text-xl text-base-content/70 font-semibold leading-relaxed max-w-xl">
                        {__("Discover, book, and enjoy — modern car rentals made simple and smart.")}
                    </p>

                    <div className="pt-2 w-full sm:w-auto">
                        <Link
                            href="/cars"
                            className="inline-flex items-center justify-center bg-(--color-primary-color) hover:bg-(--color-primary-hover) text-white font-extrabold text-base tracking-wide py-4 px-10 rounded-full shadow-lg hover:shadow-xl hover:shadow-primary/20 active:scale-98 transition-all duration-300 group w-full sm:w-auto"
                        >
                            <span>{__("Explore Cars")}</span>
                            {/* 💡 Smooth shifting arrow on link hover */}
                            <i className="fa-solid fa-arrow-right text-sm ms-2 transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform duration-200"></i>
                        </Link>
                    </div>
                </div>

                {/* 🏎️ Left/Right Column: Car Asset Wrapper */}
                <div className="w-full md:w-1/2 flex justify-center items-center">
                    {/* 💡 Soft bounce animation simulates natural car weight physics */}
                    <div className="relative w-full max-w-[440px]">
                        <img
                            src='/images/hero-car.png'
                            alt={__("Featured car")}
                            className="w-full h-auto object-contain drop-shadow-[0_25px_25px_rgba(0,0,0,0.15)] dark:drop-shadow-[0_25px_25px_rgba(0,0,0,0.6)] select-none pointer-events-none rtl:scale-x-[-1] hover:scale-105"
                        />
                        {/* Realistic under-car responsive floor shadow layer */}
                        <div className="absolute -bottom-2 left-1/2 -translate-x-1/2 w-[85%] h-4 bg-black/10 dark:bg-black/40 rounded-full blur-md -z-10" />
                    </div>
                </div>

            </div>
        </section>
    );
};

export default Hero;
