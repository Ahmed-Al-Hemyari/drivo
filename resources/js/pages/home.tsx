import Hero from '@/components/drivo-components/hero'
import Navbar from '@/components/drivo-components/navbar'
import Search from '@/components/drivo-components/search'
import React from 'react'

const home = () => {
  return (
    <div className='min-h-screen'>
        <Navbar elements={['Home', 'Cars', 'About']}/>
        <Search route='cars'/>
        <Hero/>
    </div>
  )
}

export default home
