import React, { useState } from 'react';
import { router, usePage } from '@inertiajs/react';
import { Brand, Category } from '@/types/types';
import { useTrans } from '@/helpers/useTrans';

interface FilterProps {
  filters?: { brand?: string; category?: string; price?: string; rate?: string };
  brands?: Brand[];
  categories?: Category[];
}

const Filter: React.FC<FilterProps> = ({ filters: initialFilters, brands = [], categories = [] }) => {
  const page = usePage();
  const { __ } = useTrans();
  const locale = (page.props.locale as 'en' | 'ar') || 'en';

  const [filters, setFilters] = useState({
    brand: initialFilters?.brand || '',
    category: initialFilters?.category || '',
    price: initialFilters?.price || '',
    rate: initialFilters?.rate || '',
  });

  const handleFilterChange = (key: keyof typeof filters, value: string) => {
    const updatedFilters = { ...filters, [key]: value };
    setFilters(updatedFilters);
    const query = Object.fromEntries(Object.entries(updatedFilters).filter(([_, v]) => v !== ''));
    router.get('/cars', query, { preserveScroll: true, replace: true });
  };

  const resetFilters = () => {
    setFilters({ brand: '', category: '', price: '', rate: '' });
    router.get('/cars', {}, { preserveScroll: true, replace: true });
  };

  return (
    <div className="flex flex-row flex-wrap items-center justify-center gap-4 bg-base-200/30 rounded-xl p-4 mx-3 mb-6 transition-colors">
      {/* Icon Wrapper */}
      <div className="flex items-center justify-center bg-base-200 p-2 rounded-lg border border-base-300">
        <img className="w-8 h-8 object-contain dark:invert transition-all" src="/images/filterIcon.png" alt="Filters" />
      </div>

      {/* Brand Select */}
      <div className="form-control w-full sm:w-44">
        <select
          value={filters.brand}
          onChange={(e) => handleFilterChange('brand', e.target.value)}
          className="select select-bordered select-md bg-base-200 text-base-content border-base-400 focus:border-primary w-full rounded-lg font-normal"
        >
          <option value="">{__('Brand')}</option>
          {brands.map((brand) => {
            const localizedName = brand?.[`name_${locale}`] || brand.name_en;
            return <option key={brand.id} value={localizedName}>{localizedName}</option>;
          })}
        </select>
      </div>

      {/* Category Select */}
      <div className="form-control w-full sm:w-44">
        <select
          value={filters.category}
          onChange={(e) => handleFilterChange('category', e.target.value)}
          className="select select-bordered select-md bg-base-200 text-base-content border-base-400 focus:border-primary w-full rounded-lg font-normal"
        >
          <option value="">{__('Category')}</option>
          {categories.map((category) => {
            const localizedName = category?.[`name_${locale}`] || category.name_en;
            return <option key={category.id} value={localizedName}>{localizedName}</option>;
          })}
        </select>
      </div>

      {/* Price Select */}
      <div className="form-control w-full sm:w-44">
        <select
          value={filters.price}
          onChange={(e) => handleFilterChange('price', e.target.value)}
          className="select select-bordered select-md bg-base-200 text-base-content border-base-400 focus:border-primary w-full rounded-lg font-normal"
        >
          <option value="">{__('Price')}</option>
          <option value="0-100">≤ 100$</option>
          <option value="100-300">100$ – 300$</option>
          <option value="300-500">300$ – 500$</option>
          <option value="500+">≥ 500$</option>
        </select>
      </div>

      {/* Reset */}
      <button
        onClick={resetFilters}
        className="btn btn-ghost btn-md text-base-content/80 hover:bg-base-200 rounded-lg font-medium transition-colors px-4 w-full sm:w-auto normal-case"
      >
        {__('Reset')}
      </button>
    </div>
  );
};

export default Filter;
