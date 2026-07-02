import BrandsSection from '@/components/drivo-components/brands-section';
import CategoriesSection from '@/components/drivo-components/categories-section';
import FeaturesSection from '@/components/drivo-components/features';
import Footer from '@/components/drivo-components/footer';
import Hero from '@/components/drivo-components/hero'
import Navbar from '@/components/drivo-components/navbar'
import Search from '@/components/drivo-components/search'
import { Brand, Category } from '@/types/types';
import React from 'react'

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
