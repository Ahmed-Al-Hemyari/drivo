import { useTrans } from '@/helpers/useTrans';
import { usePage } from '@inertiajs/react';
import React from 'react';

interface SearchProps {
  route: string;
}

const Search: React.FC<SearchProps> = ({ route }) => {
    const { locale } = usePage().props as any;
    const { __ } = useTrans();

    return (
    <div className="w-full bg-white">
        <form action={`/${route}`} className="w-10/12 mx-auto flex flex-row justify-between">
            <div className="relative border-2 w-full border-gray-100 m-4 rounded-full flex flex-row justify-between">
                <input
                    type="text"
                    name="search"
                    className={`h-14 w-full ${locale == 'ar' ? "pr-5 rounded-r-full" : "pl-5 rounded-l-full"} z-0 focus:shadow focus:outline-none bg-white text-gray-800`}
                    placeholder={__("Search...")}
                />
                <button
                    type="submit"
                    className={`h-14 w-35 py-4 px-6 text-white ${locale =='ar' ? "rounded-l-full" : "rounded-r-full"} bg-(--color-primary-color) hover:bg-(--color-primary-hover)`}
                >
                    {__("Search")}
                </button>
            </div>
        </form>
    </div>
    );
};

export default Search;
