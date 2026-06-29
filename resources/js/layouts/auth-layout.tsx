import { LanguageSwitcher } from '@/components/drivo-components/language-switcher';
import ThemeSwitcher from '@/components/drivo-components/theme-switcher';
import AuthLayoutTemplate from '@/layouts/auth/auth-simple-layout';

export default function AuthLayout({
    title = '',
    description = '',
    children,
}: {
    title?: string;
    description?: string;
    children: React.ReactNode;
}) {
    return (
        <div className="relative min-h-screen bg-base-200/40 dark:bg-base-300/20 text-base-content transition-colors duration-300">
            <div className="absolute top-4 end-4 z-50 flex items-center gap-2 bg-base-100/60 backdrop-blur-md p-1.5 rounded-full border border-base-200 shadow-xs transition-all">
                <ThemeSwitcher />
                <div className="w-px h-4 bg-base-300 mx-0.5"></div>
                <LanguageSwitcher />
            </div>

            <AuthLayoutTemplate title={title} description={description}>
                {children}
            </AuthLayoutTemplate>
        </div>
    );
}
