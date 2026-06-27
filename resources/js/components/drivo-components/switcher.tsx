import React, { useEffect } from 'react';
import { router, usePage } from '@inertiajs/react';

export function LanguageSwitcher() {
  const { locale } = usePage().props as any; // 'en' or 'ar'

  useEffect(() => {
    const direction = locale === 'ar' ? 'rtl' : 'ltr';
    document.documentElement.dir = direction;

    // Optional: Update the lang attribute dynamically too
    document.documentElement.lang = locale;
  }, [locale]);

  const changeLanguage = (lang: 'en' | 'ar') => {
    if (lang === locale) return;

    router.post(`/locale/${lang}`, {}, {
      preserveScroll: true, // Stops the page from jumping to top on reload
    });
  };

  return (
    <div className="dropdown dropdown-end">
      {/* Trigger Button */}
      <div tabIndex={0} role="button" className="btn btn-ghost text-white normal-case gap-2 border border-gray-700 hover:bg-gray-800">
        <i className="fa-solid fa-globe text-gray-400"></i>
        <span>{locale === 'ar' ? 'العربية' : 'English'}</span>
        <i className="fa-solid fa-chevron-down text-xs opacity-60"></i>
      </div>

      {/* Menu Options */}
      <ul tabIndex={0} className="dropdown-content menu p-2 shadow-2xl bg-base-100 rounded-box w-40 z-50 text-base-content mt-2 border border-gray-700">
        <li>
          <button
            type="button"
            onClick={() => changeLanguage('en')}
            className={`flex justify-between ${locale === 'en' ? 'active font-bold text-white' : ''}`}
          >
            <span>English</span>
            {locale === 'en' && <i className="fa-solid fa-check text-xs"></i>}
          </button>
        </li>
        <li>
          <button
            type="button"
            onClick={() => changeLanguage('ar')}
            className={`flex justify-between ${locale === 'ar' ? 'active font-bold text-white' : ''}`}
          >
            <span>العربية</span>
            {locale === 'ar' && <i className="fa-solid fa-check text-xs"></i>}
          </button>
        </li>
      </ul>
    </div>
  );
}
