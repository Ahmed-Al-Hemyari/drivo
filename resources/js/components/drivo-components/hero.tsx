import React from 'react';
import safety from '/public/images/safety.svg';
import eco from '/public/images/eco.svg';
import mobile from '/public/images/mobile.svg';
import { usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';

const Hero: React.FC = () => {
    const { locale } = usePage().props as any;
    const { __ } = useTrans();

    return (
        <section className="relative bg-linear-to-b from-white to-gray-50 py-16 md:py-24 overflow-hidden">
        <div className="flex flex-col-reverse md:flex-row items-center justify-center max-w-7xl mx-auto px-6 lg:px-12">
            {/* Text Content */}
            <div className={`flex flex-col items-center md:items-start text-center ${locale == 'ar' ? "md:text-right" : "md:text-left"} space-y-6 w-full md:w-1/2"`}>
            <h1 className="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight">
                <span className="text-(--color-primary-color)">{__("Rent")}</span>.{' '}
                <span className="text-gray-900">{__("Ride")}</span>.{' '}
                <span className="text-(--color-primary-color)">{__("Repeat")}</span>.
            </h1>
            <p className="text-lg sm:text-xl lg:text-2xl text-gray-700 font-medium max-w-xl">
                {__("Discover, book, and enjoy — modern car rentals made simple and smart.")}
            </p>
            <a
                href="/cars"
                className="bg-(--color-primary-color) hover:bg-(--color-primary-color)/90 transition-all text-lg font-semibold text-white py-3 px-10 rounded-full shadow-lg hover:shadow-xl hover:scale-105"
            >
                {__("Explore Cars →")}
            </a>
            </div>

            {/* Hero Image */}
            <div className="w-full md:w-1/2 mb-10 md:mb-0 flex justify-center">
            <img
                src='/images/hero-car.png'
                alt="Featured car"
                className="w-96 max-w-full drop-shadow-2xl hover:scale-105 transition-transform duration-500"
            />
            </div>
        </div>

        {/* Decorative line */}
        <hr className="mx-auto w-9/12 border-gray-300 my-20" />

        {/* Feature Highlights */}
        <div className="max-w-6xl mx-auto px-6 lg:px-12">
            <ul className="grid grid-cols-1 md:grid-cols-3 gap-10">
            <li className="flex flex-col items-center text-center space-y-3 p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all">
                <img className="w-20 mb-2" src='/images/safety.svg' alt="Safety icon" />
                <h2 className="text-2xl font-bold text-(--color-primary-color)">
                {__("Insurance & Safety")}
                </h2>
                <p className="text-gray-700 text-lg">
                {__("Drive with confidence — coverage included.")}
                </p>
            </li>

            <li className="flex flex-col items-center text-center space-y-3 p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all">
                <img className="w-20 mb-2" src='/images/eco.svg' alt="Eco-friendly icon" />
                <h2 className="text-2xl font-bold text-(--color-primary-color)">
                {__("Eco-Friendly Options")}
                </h2>
                <p className="text-gray-700 text-lg">
                {__("Choose hybrid or electric — drive clean, save green.")}
                </p>
            </li>

            <li className="flex flex-col items-center text-center space-y-3 p-6 bg-white rounded-2xl shadow-md hover:shadow-xl transition-all">
                <img className="w-20 mb-2" src='/images/mobile.svg' alt="Mobile icon" />
                <h2 className="text-2xl font-bold text-(--color-primary-color)">
                {__("Mobile Experience")}
                </h2>
                <p className="text-gray-700 text-lg">
                {__("Book, manage, and track your rental from anywhere.")}
                </p>
            </li>
            </ul>
        </div>

        {/* Subtle background accent */}
        <div className="absolute -bottom-40 -right-40 w-96 h-96 bg-(--color-primary-color)/10 rounded-full blur-3xl pointer-events-none"></div>
        </section>
    );
};

export default Hero;
