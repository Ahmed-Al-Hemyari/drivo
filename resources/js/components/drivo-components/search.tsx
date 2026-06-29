import React, { useState, useEffect } from 'react';
import { router, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';

interface SearchProps { route: string; }

const Search: React.FC<SearchProps> = ({ route }) => {
  const page = usePage();
  const { __ } = useTrans();

  const getInitialSearch = () => {
    if (typeof window !== 'undefined') {
      return new URLSearchParams(window.location.search).get('search') || '';
    }
    return '';
  };

  const [searchQuery, setSearchQuery] = useState<string>(getInitialSearch);

  useEffect(() => {
    setSearchQuery(new URLSearchParams(window.location.search).get('search') || '');
  }, [page.url]);

  const handleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    const params = new URLSearchParams(window.location.search);
    if (searchQuery.trim()) params.set('search', searchQuery.trim());
    else params.delete('search');
    router.get(`/${route}`, Object.fromEntries(params.entries()), { preserveScroll: true, replace: true });
  };

  const handleClear = () => {
    setSearchQuery('');
    const params = new URLSearchParams(window.location.search);
    params.delete('search');
    router.get(`/${route}`, Object.fromEntries(params.entries()), { preserveScroll: true, replace: true });
  };

  return (
    <div className="w-full bg-base-200/40 py-4 transition-colors">
      <form onSubmit={handleSearch} className="w-11/12 max-w-4xl mx-auto">
        <div className="join w-full shadow-md rounded-full border border-base-200 bg-base-100 p-1 transition-all focus-within:ring-2 focus-within:ring-primary/20">
          <div className="relative flex-1 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 absolute start-4 text-base-content/40 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
              type="text"
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              placeholder={__("Search...")}
              className="input input-ghost w-full ps-12 pe-12 text-base text-base-content placeholder-base-content/40 focus:outline-none focus:bg-transparent h-12"
            />
            {searchQuery && (
              <button type="button" onClick={handleClear} className="btn btn-ghost btn-circle btn-xs absolute end-3 text-base-content/40 hover:text-base-content">✕</button>
            )}
          </div>
          <button
            type="submit"
            className="btn btn-primary join-item rounded-full px-8 h-12 min-h-[3rem] text-white tracking-wide transition-all active:scale-95"
            style={{ backgroundColor: 'var(--color-primary-color)', borderColor: 'var(--color-primary-color)' }}
          >
            {__("Search")}
          </button>
        </div>
      </form>
    </div>
  );
};

export default Search;
