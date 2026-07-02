import { Link, router, usePage } from '@inertiajs/react';
import React from 'react';
import { useTrans } from '@/helpers/useTrans';
import type { User } from '@/types';
import FlashMessages from './flash-messages';
import { LanguageSwitcher } from './language-switcher';
import ThemeSwitcher from './theme-switcher';

interface PageProps {
  auth: { user: User | null };
  [key: string]: any;
}

interface NavbarProps {
  elements: string[];
}

const Navbar: React.FC<NavbarProps> = ({ elements }) => {
  const { __ } = useTrans();
  const { auth } = usePage<PageProps>().props;
  const user = auth?.user;
  const locale = (usePage().props.locale as 'en' | 'ar') || 'en';

  const logout = () => router.post('/logout');

  return (
    <>
        <FlashMessages/>
        <nav className="navbar justify-between items-center px-4 sm:px-6 py-2.5 bg-base-100 border-b border-base-200 text-base-content sticky top-0 z-50 transition-all duration-300 backdrop-blur-md bg-opacity-95 shadow-xs">

        {/* 📱 LEFT SIDE: Hamburger (Mobile) + Logo (All) */}
        <div className="navbar-start gap-1 sm:gap-2">
            {/* Mobile Hamburger Dropdown Menu */}
            <div className="dropdown md:hidden">
            <div tabIndex={0} role="button" className="btn btn-ghost btn-circle text-base-content/80">
                <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
            <ul
                tabIndex={0}
                className="dropdown-content menu menu-sm p-2 shadow-xl bg-base-100 rounded-2xl w-52 mt-3 border border-base-200 z-50 font-medium"
            >
                {elements?.map((element) => (
                <li key={element}>
                    <Link
                    href={element === 'Home' ? '/' : `/${element.toLocaleLowerCase()}`}
                    className="py-2.5 rounded-xl active:bg-primary/10 active:text-primary"
                    >
                    <span>{__(element)}</span>
                    </Link>
                </li>
                ))}
            </ul>
            </div>

            {/* Brand Logo */}
            <Link href="/" className="transition-transform duration-200 active:scale-95 flex items-center">
            <img className="h-7 sm:h-8 w-auto hidden dark:block" src='/drivo-dark-logo.svg' alt="Logo" />
            <img className="h-7 sm:h-8 w-auto block dark:hidden" src='/drivo-light-logo.svg' alt="Logo" />
            </Link>
        </div>

        {/* 💻 CENTER: Navigation Links (Desktop Only) */}
        <div className="navbar-center hidden md:flex">
            <ul className="menu menu-horizontal px-1 gap-1 text-sm font-medium">
            {elements?.map((element) => (
                <li key={element}>
                <Link
                    href={element === 'Home' ? '/' : `/${element.toLocaleLowerCase()}`}
                    className="hover:text-(--color-primary-hover) hover:bg-base-200/60 rounded-xl transition-colors normal-case px-4 py-2"
                >
                    <span>{__(element)}</span>
                </Link>
                </li>
            ))}
            </ul>
        </div>

        {/* 🛠️ RIGHT SIDE: Theme, Language & Auth State */}
        <div className="navbar-end gap-1 sm:gap-2.5">
            <ThemeSwitcher />
            <LanguageSwitcher />

            {user ? (
            <div className="dropdown dropdown-end">
                <div
                tabIndex={0}
                role="button"
                className="btn btn-ghost hover:bg-base-200/60 rounded-full p-1 sm:ps-2 sm:pe-4 flex items-center gap-2 h-auto normal-case border border-transparent hover:border-base-300 transition-all duration-200"
                >
                <div className="avatar">
                    <div className="w-8 sm:w-9 rounded-full ring-2 ring-primary/20 ring-offset-base-100 ring-offset-2">
                    <img
                        src={user.avatar ? `/storage/${user.avatar}` : '/images/no-image-user.webp'}
                        alt={user.name}
                    />
                    </div>
                </div>

                {/* Desktop Metadata Frame */}
                <div className="hidden sm:flex flex-col items-start text-left rtl:text-right">
                    <span className="text-sm font-semibold text-base-content max-w-[90px] truncate">
                    {user.name}
                    </span>
                    <span className="text-[11px] text-base-content/50 font-normal leading-none mt-0.5">
                    {user.role?.[`label_${locale}` as keyof typeof user.role] || ''}
                    </span>
                </div>
                <i className="fa-solid fa-chevron-down text-[10px] opacity-40 hidden sm:block"></i>
                </div>

                <ul
                tabIndex={0}
                className="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-2xl w-56 border border-base-200 mt-3 animate-slide-in text-sm font-medium z-50"
                >
                {/* Mobile Header Context (shows user details only on mobile drop down) */}
                <li className="sm:hidden px-4 py-2.5 border-b border-base-200 mb-1 text-left rtl:text-right">
                    <span className="font-bold text-base-content block text-sm">{user.name}</span>
                    <span className="text-xs text-base-content/50 font-normal block mt-0.5">
                    {user.role?.[`label_${locale}` as keyof typeof user.role] || ''}
                    </span>
                </li>

                <li>
                    <Link href="/profile" className="flex items-center gap-3 py-2.5 rounded-xl hover:bg-base-200">
                    <i className="fa-regular fa-user text-base opacity-70 w-4"></i>
                    <span>{__('Profile')}</span>
                    </Link>
                </li>

                <li>
                    <Link href="/bookings" className="flex items-center gap-3 py-2.5 rounded-xl hover:bg-base-200">
                    <i className="fa-regular fa-calendar-check text-base opacity-70 w-4"></i>
                    <span>{__('Bookings')}</span>
                    </Link>
                </li>

                <li>
                    <Link href="/reset-password" className="flex items-center gap-3 py-2.5 rounded-xl hover:bg-base-200">
                    <i className="fa-regular fa-calendar-check text-base opacity-70 w-4"></i>
                    <span>{__('Reset Password')}</span>
                    </Link>
                </li>

                <div className="divider my-1 opacity-60"></div>

                <li>
                    <button
                    onClick={logout}
                    className="flex items-center gap-3 py-2.5 rounded-xl text-error hover:bg-error/15 hover:text-error active:bg-error/20"
                    >
                    <i className="fa-solid fa-arrow-right-from-bracket text-base w-4"></i>
                    <span>{__("Logout")}</span>
                    </button>
                </li>
                </ul>
            </div>
            ) : (
            <Link
                href="/login"
                as="button"
                className="btn btn-sm sm:btn-md h-9 min-h-0 bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white rounded-full px-4 sm:px-6 shadow-xs active:scale-95 transition-all text-xs sm:text-sm font-medium"
            >
                {__("Login")}
            </Link>
            )}
        </div>
        </nav>
    </>
  );
};

export default Navbar;
