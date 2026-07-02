import { router, usePage } from '@inertiajs/react';
import React, { useEffect } from 'react';

export function LanguageSwitcher() {
  const { locale } = usePage().props as any; // 'en' or 'ar'

  useEffect(() => {
    const direction = locale === 'ar' ? 'rtl' : 'ltr';
    document.documentElement.dir = direction;
    document.documentElement.lang = locale;
  }, [locale]);

  const changeLanguage = (lang: 'en' | 'ar') => {
    if (lang === locale) {
return;
}

    router.post(`/locale/${lang}`, {}, {
      preserveScroll: true,
    });
  };

  return (
    /* Removed data-theme='dark' to let global theme trickle down */
    <div className="dropdown dropdown-end">
      {/* Trigger Button - Enhanced to match the profile capsule style */}
      <div
        tabIndex={0}
        role="button"
        className="btn btn-ghost hover:bg-base-200/60 rounded-full py-1.5 px-4 flex items-center gap-2 h-auto normal-case border border-transparent hover:border-base-300 text-base-content font-medium transition-all duration-200"
      >
        <i className="fa-solid fa-globe text-base-content/50 text-sm"></i>
        <span className="text-sm hidden sm:inline">
          {locale === 'ar' ? 'العربية' : 'English'}
        </span>
        {/* Short code badge for tiny mobile screens */}
        <span className="text-xs font-bold uppercase sm:hidden bg-base-200 px-1.5 py-0.5 rounded-md">
          {locale}
        </span>
        <i className="fa-solid fa-chevron-down text-[10px] opacity-40"></i>
      </div>

      {/* Menu Options */}
      <ul
        tabIndex={0}
        className="dropdown-content menu p-1.5 shadow-xl bg-base-100 rounded-2xl w-40 z-50 text-base-content mt-3 border border-base-200 animate-slide-in text-sm font-medium"
      >
        <li>
          <button
            type="button"
            onClick={() => changeLanguage('en')}
            className={`flex items-center justify-between py-2.5 rounded-xl transition-colors hover:bg-base-200 ${
              locale === 'en'
                ? 'bg-(--color-primary-color)/10 text-(--color-primary-color) hover:bg-(--color-primary-color)/15 font-bold'
                : 'text-base-content/80'
            }`}
          >
            <span>English</span>
            {locale === 'en' && <i className="fa-solid fa-check text-xs"></i>}
          </button>
        </li>
        <li>
          <button
            type="button"
            onClick={() => changeLanguage('ar')}
            className={`flex items-center justify-between py-2.5 rounded-xl transition-colors hover:bg-base-200 ${
              locale === 'ar'
                ? 'bg-(--color-primary-color)/10 text-(--color-primary-color) hover:bg-(--color-primary-color)/15 font-bold'
                : 'text-base-content/80'
            }`}
          >
            <span>العربية</span>
            {locale === 'ar' && <i className="fa-solid fa-check text-xs"></i>}
          </button>
        </li>
      </ul>
    </div>
  );
}
