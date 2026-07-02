import Footer from '@/components/drivo-components/footer';
import Navbar from '@/components/drivo-components/navbar';
import AppLayoutTemplate from '@/layouts/app/app-sidebar-layout';
import type { BreadcrumbItem } from '@/types';

export default function AppLayout({
    breadcrumbs = [],
    children,
}: {
    breadcrumbs?: BreadcrumbItem[];
    children: React.ReactNode;
}) {
    return (
        <AppLayoutTemplate breadcrumbs={breadcrumbs}>
            <Navbar elements={['Home', 'Cars', 'About']}/>
                {children}
            <Footer/>
        </AppLayoutTemplate>
    );
}
