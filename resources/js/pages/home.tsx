import React from 'react'
import BrandsSection from '@/components/drivo-components/brands-section';
import CategoriesSection from '@/components/drivo-components/categories-section';
import FeaturesSection from '@/components/drivo-components/features';
import Hero from '@/components/drivo-components/hero'
import type { Brand, Category } from '@/types/types';

interface HomeProps {
    categories: Category[];
    brands: Brand[];
}

const home = ({ categories, brands}: HomeProps) => {
  return (
    <div className='min-h-screen'>
        {/* <Search route='cars'/> */}
        <Hero/>
        <FeaturesSection/>
        <BrandsSection brands={brands}/>
        <CategoriesSection categories={categories}/>
    </div>
  )
}

export default home
