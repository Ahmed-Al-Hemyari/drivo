import React, { useState, useMemo } from 'react';
import { router, usePage } from '@inertiajs/react';
import { Brand, Category } from '@/types/types';
import { useTrans } from '@/helpers/useTrans';

interface FilterProps {
  filters?: {
    brand?: string;
    category?: string;
    price?: string;
    rate?: string;
  };
  brands?: Brand[];
  categories?: Category[];
  cars?: any[];
}

const Filter: React.FC<FilterProps> = ({ filters: initialFilters, brands = [], categories = [] }) => {
  // Access Inertia page context (safely casting type)
  const page = usePage();
  const { __ } = useTrans();
  const locale = (page.props.locale as 'en' | 'ar') || 'en';

  // Track filter state locally using the aliased initial prop values
  const [filters, setFilters] = useState({
    brand: initialFilters?.brand || '',
    category: initialFilters?.category || '',
    price: initialFilters?.price || '',
    rate: initialFilters?.rate || '',
  });

  // Handle value alteration and fire backend router requests
  const handleFilterChange = (key: keyof typeof filters, value: string) => {
    const updatedFilters = { ...filters, [key]: value };
    setFilters(updatedFilters);

    // Omit empty string pairs dynamically just like Object.fromEntries in your Vue code
    const query = Object.fromEntries(
      Object.entries(updatedFilters).filter(([_, v]) => v !== '')
    );

    router.get('/cars', query, { preserveScroll: true, replace: true });
  };

  // Reset values clean
  const resetFilters = () => {
    setFilters({ brand: '', category: '', price: '', rate: '' });
    router.get('/cars', {}, { preserveScroll: true, replace: true });
  };

  return (
    <div
      data-theme="light"
      className="flex flex-row flex-wrap items-center justify-center gap-4 bg-white border border-slate-100 rounded-xl p-4 shadow-sm mx-3 mb-6"
    >
      {/* Icon Indicator Container */}
      <div className="flex items-center justify-center bg-slate-50 p-2 rounded-lg border border-slate-100">
        <img className="w-8 h-8 object-contain" src="/images/filterIcon.png" alt="Filter parameters" />
      </div>

      {/* Brand Selector */}
      <div className="form-control w-full sm:w-44">
        <select
          value={filters.brand}
          onChange={(e) => handleFilterChange('brand', e.target.value)}
          className="select select-bordered select-md bg-white border-slate-200 text-slate-700 focus:border-slate-400 w-full rounded-lg font-normal"
        >
          <option value="">{__('Brand')}</option>
          {brands.map((brand) => {
            const localizedName = brand?.[`name_${locale}`] || brand.name_en;
            return (
              <option key={brand.id} value={localizedName}>
                {localizedName}
              </option>
            );
          })}
        </select>
      </div>

      {/* Category Selector */}
      <div className="form-control w-full sm:w-44">
        <select
          value={filters.category}
          onChange={(e) => handleFilterChange('category', e.target.value)}
          className="select select-bordered select-md bg-white border-slate-200 text-slate-700 focus:border-slate-400 w-full rounded-lg font-normal"
        >
          <option value="">{__('Category')}</option>
          {categories.map((category) => {
            const localizedName = category?.[`name_${locale}`] || category.name_en;
            return (
              <option key={category.id} value={localizedName}>
                {localizedName}
              </option>
            );
          })}
        </select>
      </div>

      {/* Price Selector */}
      <div className="form-control w-full sm:w-44">
        <select
          value={filters.price}
          onChange={(e) => handleFilterChange('price', e.target.value)}
          className="select select-bordered select-md bg-white border-slate-200 text-slate-700 focus:border-slate-400 w-full rounded-lg font-normal"
        >
          <option value="">{__('Price')}</option>
          <option value="0-100">≤ 100$</option>
          <option value="100-300">100$ – 300$</option>
          <option value="300-500">300$ – 500$</option>
          <option value="500+">≥ 500$</option>
        </select>
      </div>

      {/* Reset Trigger Action */}
      <button
        onClick={resetFilters}
        className="btn btn-ghost btn-md text-slate-500 hover:bg-slate-100 hover:text-slate-800 rounded-lg font-medium transition-colors px-4 w-full sm:w-auto normal-case"
      >
        {__('Reset')}
      </button>
    </div>
  );
};

export default Filter;
