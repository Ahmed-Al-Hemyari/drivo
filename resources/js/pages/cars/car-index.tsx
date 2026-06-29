import React from 'react';
import CarCard from '@/components/drivo-components/car-card';
import Filter from '@/components/drivo-components/filter';
import Navbar from '@/components/drivo-components/navbar';
import { Pagination } from '@/components/drivo-components/pagination';
import Search from '@/components/drivo-components/search';
import { useTrans } from '@/helpers/useTrans';
import { Brand, Car, Category, LinkItem } from '@/types/types';

interface LaravelPagination<T> {
  data: T[];
  links: LinkItem[];
  current_page?: number;
  last_page?: number;
  total?: number;
}

interface CarIndexProps {
  cars: LaravelPagination<Car>;
  brands: Brand[];
  categories: Category[];
  filters: { brand?: string; category?: string; price?: string; rate?: string };
}

const CarIndex: React.FC<CarIndexProps> = ({ cars, brands, categories, filters }) => {
    const { __ } = useTrans();

    return (
        <div className='min-h-screen bg-base-200/40 text-base-content transition-colors'>
            <Navbar elements={['Home', 'Cars', 'About']}/>
            <Search route='cars'/>
            <Filter brands={brands} categories={categories} filters={filters}/>

            {cars?.data.length > 0 ? (
                <div className="p-5">
                    <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        {cars.data.map((car) => (
                            <CarCard key={car.id} car={car} />
                        ))}
                    </div>
                    <Pagination links={cars.links} />
                </div>
            ) : (
                <p className="text-center text-base-content/60 italic py-6">
                    {__('No cars found')}
                </p>
            )}
        </div>
    );
};

export default CarIndex;
