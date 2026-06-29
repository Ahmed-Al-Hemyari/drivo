import React from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import { User } from '@/types';
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

  const logout = () => router.post('/logout');

  return (
    <nav className="navbar justify-between items-center px-6 py-3 bg-base-100 border-b border-base-200 text-base-content sticky top-0 z-50 transition-all duration-300 backdrop-blur-md bg-opacity-95 shadow-md">
      {/* Brand Logo Area */}
      <div className="navbar-start w-auto">
        <Link href="/" className="transition-transform duration-200 active:scale-95">
          <img className="h-9 w-auto hidden dark:block" src='/drivo-dark-logo.svg' alt="Logo" />
          <img className="h-9 w-auto block dark:hidden" src='/drivo-light-logo.svg' alt="Logo" />
        </Link>
      </div>

      {/* Navigation & Controls Wrapper */}
      <div className="navbar-end flex items-center gap-6 flex-1 justify-end">
        {/* Navigation Links */}
        <ul className="hidden md:flex items-center space-x-1 text-sm font-medium">
          {elements?.map((element) => (
            <li key={element}>
              <Link
                href={element === 'Home' ? '/' : `/${element.toLocaleLowerCase()}`}
                className="btn btn-ghost btn-sm text-base-content/80 hover:text-(--color-primary-hover) rounded-lg transition-colors normal-case px-3"
              >
                <span>{__(element)}</span>
              </Link>
            </li>
          ))}
        </ul>

        {/* Global Controls Partition */}
        <div className="flex items-center gap-3 border-l border-base-300 ps-4 rtl:border-l-0 rtl:border-r rtl:ps-0 rtl:pe-4">
          <ThemeSwitcher />
          <LanguageSwitcher />

          {user ? (
            /* Refactored Profile Menu Control Container */
            <div className="dropdown dropdown-end">
              <div
                tabIndex={0}
                role="button"
                className="btn btn-ghost hover:bg-base-200/60 rounded-full py-1.5 ps-2 pe-4 flex items-center gap-3 h-auto normal-case border border-transparent hover:border-base-300 transition-all duration-200"
              >
                {/* Clean daisyUI Avatar implementation */}
                <div className="avatar">
                  <div className="w-9 rounded-full ring-2 ring-primary/20 ring-offset-base-100 ring-offset-2">
                    <img
                      src={user.avatar ? `/storage/${user.avatar}` : '/images/no-image-user.webp'}
                      alt={user.name}
                    />
                  </div>
                </div>
                {/* Horizontal meta info */}
                <div className="hidden sm:flex flex-col items-start text-left rtl:text-right">
                  <span className="text-sm font-semibold text-base-content max-w-[100px] truncate">
                    {user.name}
                  </span>
                  <span className="text-[11px] text-base-content/50 font-normal leading-none mt-0.5">
                    {__('Customer')}
                  </span>
                </div>
                <i className="fa-solid fa-chevron-down text-[10px] opacity-40 hidden sm:block"></i>
              </div>

              {/* Styled Dropdown Elements Tray */}
              <ul
                tabIndex={0}
                className="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-2xl w-56 border border-base-200 mt-3 animate-slide-in text-sm font-medium"
              >
                {/* Mobile Meta Header Context */}
                <li className="sm:hidden px-4 py-3 border-b border-base-200 mb-1">
                  <span className="font-bold text-base-content">{user.name}</span>
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
              className="btn btn-sm bg-(--color-primary-color) hover:bg-(--color-primary-hover) border-none text-white rounded-full px-6 shadow-sm active:scale-95 transition-all"
            >
              {__("Login")}
            </Link>
          )}
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
