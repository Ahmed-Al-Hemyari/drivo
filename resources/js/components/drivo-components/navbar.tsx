import React, { useState, useEffect, useRef } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import { User } from '@/types';
import { LanguageSwitcher } from './switcher';

// Types & Interfaces
interface PageProps {
  auth: {
    user: User | null;
  };
  [key: string]: any;
}

interface NavbarProps {
  elements: string[];
}

const Navbar: React.FC<NavbarProps> = ({ elements }) => {
    const { __ } = useTrans();

  // Inertia page props hook
  const { auth } = usePage<PageProps>().props;
  const user = auth?.user;

  // Component States & Refs
  const profileContainer = useRef<HTMLDivElement>(null);

  const logout = () => {
    router.post('/logout');
  };

  return (
    <nav className="flex justify-between items-center p-5 bg-gray-900">
      <Link href="/" className="mr-5">
        <img className="w-54" src='/drivo-dark-logo.svg' alt="Logo" />
      </Link>

      <ul className="flex items-center space-x-6 mr-6 text-lg">
        {/* Dynamic Navigation Links (replaces v-for) */}
        {elements?.map((element) => (
          <li key={element}>
            <Link
              href={element === 'Home' ? '/' : `/${element.toLocaleLowerCase()}`}
              className="text-lg sm:text-xl text-white font-medium hover:text-(--color-primary-color)"
            >
              <i className="fa-solid fa-arrow-right-to-bracket"></i>
              <span>{__(element)}</span>
            </Link>
          </li>
        ))}
        <LanguageSwitcher />

        {/* Auth Condition block (replaces v-if / v-else) */}
        {user ? (
            <li>
                <div className="dropdown dropdown-start">
                    <div tabIndex={0} role="button" className="btn m-1">
                        <div
                            className="flex flex-col items-center cursor-pointer transition-transform duration-200 hover:scale-105"
                        >
                            <div className="relative w-12 h-12 rounded-full overflow-hidden ring-2 ring-white ring-offset-2">
                            <img
                                src={user.avatar ? `/storage/${user.avatar}` : '/images/no-image-user.webp'}
                                alt="Profile"
                                className="w-full h-full object-cover"
                            />
                            </div>
                            <p className="text-white text-sm font-medium mt-1">
                            {user.name}
                            </p>
                        </div>
                    </div>
                    <ul tabIndex="-1" className="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                        <li><Link href="/profile">{__('Profile')}</Link></li>
                        <li><button onClick={logout}>{__("Logout")}</button></li>
                    </ul>
                </div>
            </li>
        ) : (
          <li>
            <Link
              href="/login"
              method="get"
              as="button"
              className="bg-(--color-primary-color) hover:bg-(--color-primary-hover) text-md text-white px-4 py-2 rounded-full"
            >
              <i className="fa-solid fa-arrow-right-to-bracket"></i>
              {__("Login")}
            </Link>
          </li>
        )}
      </ul>
    </nav>
  );
};

export default Navbar;
