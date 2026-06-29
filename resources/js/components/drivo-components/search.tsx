import React, { useState, useEffect } from 'react';
import { router, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';

interface SearchProps {
  route: string;
}

const Search: React.FC<SearchProps> = ({ route }) => {
  const page = usePage();
  const { __ } = useTrans();

  // Initialize state directly from the URL query parameters if they exist
  const getInitialSearch = () => {
    if (typeof window !== 'undefined') {
      const params = new URLSearchParams(window.location.search);
      return params.get('search') || '';
    }
    return '';
  };

  const [searchQuery, setSearchQuery] = useState<string>(getInitialSearch);

  // Keep the input field synced if query parameters change via filters or pagination
  useEffect(() => {
    const params = new URLSearchParams(window.location.search);
    setSearchQuery(params.get('search') || '');
  }, [page.url]);

  // Handle SPA search submission without full page refreshes
  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();

    const params = new URLSearchParams(window.location.search);

    if (searchQuery.trim()) {
      params.set('search', searchQuery.trim());
    } else {
      params.delete('search'); // Remove key cleanly if empty string
    }

    // Convert URLSearchParams back to a plain object matching Inertia's signatures
    const queryData = Object.fromEntries(params.entries());

    router.get(`/${route}`, queryData, {
      preserveScroll: true,
      replace: true,
    });
  };

  // UX Improvement: Clear search quickly
  const handleClear = () => {
    setSearchQuery('');
    const params = new URLSearchParams(window.location.search);
    params.delete('search');

    router.get(`/${route}`, Object.fromEntries(params.entries()), {
      preserveScroll: true,
      replace: true,
    });
  };

  return (
    <div className="w-full bg-base-100 py-4" data-theme='light'>
      <form onSubmit={handleSearch} className="w-11/12 max-w-4xl mx-auto">
        {/* DaisyUI Join input grouping structure */}
        <div className="join w-full shadow-md rounded-full border border-base-200 bg-white p-1 transition-shadow hover:shadow-lg focus-within:ring-2 focus-within:ring-primary/20">

          <div className="relative flex-1 flex items-center">
            {/* Search Icon — Uses 'start-4' to adjust correctly across LTR and RTL orientations */}
            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="h-5 w-5 absolute start-4 text-base-content/40 pointer-events-none"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder={__("Search...")}
              className="input input-ghost w-full ps-12 pe-12 text-base text-slate-800 placeholder-slate-400 focus:outline-none focus:bg-transparent h-12 bg-transparent"
            />

            {/* Clear Input Button Trigger (Appears only when text is actively populated) */}
            {searchQuery && (
              <button
                type="button"
                onClick={handleClear}
                className="btn btn-ghost btn-circle btn-xs absolute end-3 text-base-content/40 hover:text-base-content"
                aria-label="Clear search query"
              >
                ✕
              </button>
            )}
          </div>

          {/* Submit Action Control */}
          <button
            type="submit"
            className="btn btn-primary join-item rounded-full px-8 h-12 min-h-[3rem] text-white tracking-wide transition-all active:scale-95"
            style={{
              backgroundColor: 'var(--color-primary-color, var(--color-red))',
              borderColor: 'var(--color-primary-color, var(--color-red))'
            }}
          >
            {__("Search")}
          </button>
        </div>
      </form>
    </div>
  );
};

export default Search;
