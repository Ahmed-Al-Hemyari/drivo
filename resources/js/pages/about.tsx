import React from 'react';
import { usePage } from '@inertiajs/react';
import Navbar from '@/components/drivo-components/navbar';
import { useTrans } from '@/helpers/useTrans';

const About: React.FC = () => {
  const { __ } = useTrans();

  const benefits = [
    __("A diverse and constantly updated fleet of high-quality vehicles."),
    __("Transparent, up-front pricing with zero hidden fees."),
    __("24/7 dedicated customer support to assist you anywhere on the road."),
    __("Flexible booking cancellation and rental extension options.")
  ];

  return (
    /* 🎨 Layer 0: Page Canvas Layout */
    <div className="min-h-screen bg-base-200/50 text-base-content transition-colors duration-300">
      {/* Dynamic Theme Compatible Navbar */}
      <Navbar elements={['Home', 'Cars', 'About']} />

      {/* Main Container Layout */}
      <section className="max-w-5xl mx-auto px-6 py-16 md:py-24">

        {/* Intro / Header Banner */}
        <div className="text-center mb-16">
          <h1 className="text-5xl md:text-6xl font-extrabold mb-6 bg-linear-to-r from-(--color-primary-color) to-rose-600 text-transparent bg-clip-text">
            {__("About Us")}
          </h1>
          <p className="text-lg md:text-xl text-base-content/70 max-w-2xl mx-auto leading-relaxed">
            {__("Driven by convenience, powered by trust — we’re here to redefine the way you rent cars.")}
          </p>
        </div>

        {/* 🎨 Layer 1: Core Mission Card Container */}
        <div className="card bg-base-100 shadow-sm hover:shadow-md border border-base-200 p-8 md:p-12 mb-16 transition-all duration-300 relative overflow-hidden group">
          {/* Distinct top border tag styling matching app primary hue */}
          <div className="absolute top-0 inset-x-0 h-1 bg-(--color-primary-color)"></div>

          <div className="space-y-6 text-base-content/80 text-lg leading-relaxed">
            <p>
              {__("Our company was founded with a simple mission: to make car rental effortless, reliable, and tailored to your needs. Whether you're planning a weekend escape, attending a business meeting, or navigating daily life, we offer a wide selection of vehicles to match your journey — from fuel-efficient compacts to spacious SUVs and premium sedans.")}
            </p>
            <p>
              {__("Every vehicle in our fleet is carefully maintained, thoroughly cleaned, and regularly inspected to ensure safety and comfort. Our team is passionate about delivering a smooth experience from the moment you book to the moment you return the keys.")}
            </p>
          </div>
        </div>

        {/* Section Heading Indicator */}
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold mb-3 text-base-content">
            {__("Why Choose Us?")}
          </h2>
          <div className="w-16 h-1 bg-(--color-primary-color) rounded-full mx-auto"></div>
        </div>

        {/* 🎨 Layer 1: Grid Block Display */}
        <ul className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16">
          {benefits.map((benefit, i) => (
            <li
              key={i}
              className="card bg-base-100 border border-base-200 p-6 shadow-xs hover:shadow-md transition-all duration-300 flex flex-row items-start gap-4 group/item"
            >
              {/* Dynamic Number Badge utilizing primary background opacities */}
              <div className="w-10 h-10 flex items-center justify-center rounded-xl bg-(--color-primary-color)/10 text-(--color-primary-color) text-xl font-black shrink-0 transition-colors group-hover/item:bg-(--color-primary-color) group-hover/item:text-white">
                {i + 1}
              </div>
              <p className="text-base text-base-content/80 leading-relaxed pt-1 text-left rtl:text-right w-full">
                {benefit}
              </p>
            </li>
          ))}
        </ul>

        {/* Closing Action Footer Card Banner */}
        <div className="bg-linear-to-r from-(--color-primary-color) to-rose-800 text-white p-8 md:p-12 rounded-2xl shadow-lg relative overflow-hidden text-center">
          <p className="text-lg md:text-xl font-medium leading-relaxed max-w-3xl mx-auto relative z-10">
            {__("Our mission is to redefine car rental by combining technology, comfort, and customer care. Every vehicle is thoroughly inspected, every interaction designed to be seamless — because we believe renting a car should feel as effortless as driving one.")}
          </p>
          {/* Subtle background decoration orb */}
          <div className="absolute -right-16 -bottom-16 w-44 h-44 bg-white/5 rounded-full blur-xl pointer-events-none"></div>
        </div>

      </section>
    </div>
  );
};

export default About;
