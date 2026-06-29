import React from 'react';
import { usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';

const Hero: React.FC = () => {
    const { locale } = usePage().props as any;
    const { __ } = useTrans();

    return (
        <section className="relative bg-linear-to-b from-base-200/40 to-base-200/40 py-16 md:py-24 overflow-hidden transition-colors">
        <div className="flex flex-col-reverse md:flex-row items-center justify-center max-w-7xl mx-auto px-6 lg:px-12">
            <div className={`flex flex-col items-center md:items-start text-center ${locale === 'ar' ? "md:text-right" : "md:text-left"} space-y-6 w-full md:w-1/2`}>
            <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
                <span className="text-(--color-primary-color)">{__("Rent")}</span>.{' '}
                <span className="text-base-content">{__("Ride")}</span>.{' '}
                <span className="text-(--color-primary-color)">{__("Repeat")}</span>.
            </h1>
            <p className="text-lg sm:text-xl lg:text-2xl text-base-content/80 font-medium max-w-xl">
                {__("Discover, book, and enjoy — modern car rentals made simple and smart.")}
            </p>
            <a
                href="/cars"
                className="bg-(--color-primary-color) hover:bg-(--color-primary-color)/90 transition-all text-lg font-semibold text-white py-3 px-10 rounded-full shadow-lg hover:shadow-xl hover:scale-105"
            >
                {__("Explore Cars →")}
            </a>
            </div>

            <div className="w-full md:w-1/2 mb-10 md:mb-0 flex justify-center">
            <img src='/images/hero-car.png' alt="Featured car" className="w-96 max-w-full drop-shadow-2xl hover:scale-105 transition-transform duration-500" />
            </div>
        </div>

        <hr className="mx-auto w-9/12 border-base-300 my-20" />

        <div className="max-w-6xl mx-auto px-6 lg:px-12">
            <ul className="grid grid-cols-1 md:grid-cols-3 gap-10">
            {['safety', 'eco', 'mobile'].map((icon, i) => {
                const titles = [__("Insurance & Safety"), __("Eco-Friendly Options"), __("Mobile Experience")];
                const descs = [__("Drive with confidence — coverage included."), __("Choose hybrid or electric — drive clean, save green."), __("Book, manage, and track your rental from anywhere.")];
                return (
                    <li key={icon} className="flex flex-col items-center text-center space-y-3 p-6 bg-base-100 border border-base-200 rounded-2xl shadow-md hover:shadow-xl transition-all">
                        <img className="w-20 mb-2 dark:brightness-90" src={`/images/${icon}.svg`} alt="" />
                        <h2 className="text-2xl font-bold text-(--color-primary-color)">{titles[i]}</h2>
                        <p className="text-base-content/80 text-lg">{descs[i]}</p>
                    </li>
                );
            })}
            </ul>
        </div>
        <div className="absolute -bottom-40 -right-40 w-96 h-96 bg-(--color-primary-color)/10 rounded-full blur-3xl pointer-events-none"></div>
        </section>
    );
};

export default Hero;
