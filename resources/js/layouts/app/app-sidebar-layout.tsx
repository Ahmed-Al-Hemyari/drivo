import type { AppLayoutProps } from '@/types';

export default function AppSidebarLayout({
    children,
}: AppLayoutProps) {
    return (
        <div>
            {children}
        </div>
        // <AppShell variant="sidebar">
        //     <AppSidebar />
        //     <AppContent variant="sidebar" className="overflow-x-hidden">
        //         <AppSidebarHeader breadcrumbs={breadcrumbs} />
        //         {children}
        //     </AppContent>
        // </AppShell>
    );
}
