import React, { useEffect, useState } from 'react'

const ThemeSwitcher = () => {
    const [theme, setTheme] = useState<string>(() => {
        return localStorage.getItem('theme') || 'light';
    });

    // Watch theme changes to update HTML element and document cookies
    useEffect(() => {
        document.documentElement.setAttribute('data-theme', theme);

        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        localStorage.setItem('theme', theme);

        document.cookie = `appearance=${theme}; path=/; max-age=${365 * 24 * 60 * 60}; SameSite=Lax`;
    }, [theme]);

    const toggleTheme = (e: React.ChangeEvent<HTMLInputElement>) => {
        setTheme(e.target.checked ? 'dark' : 'light');
    };

    return (
        <div>
            <label className="swap swap-rotate">
                {/* Checkbox state mirrors our theme value */}
                <input
                    type="checkbox"
                    onChange={toggleTheme}
                    checked={theme === 'dark'}
                    className="hidden" // Hiding natively since we rely on daisyUI .swap
                />

                {/* Sun Icon (Shows when theme is 'dark', clicking switches to light) */}
                <svg
                    className="swap-on h-8 w-8 fill-current text-yellow-500"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                >
                    <path d="M12,7a5,5,0,1,0,5,5A5,5,0,0,0,12,7Zm0,8a3,3,0,1,1,3-3A3,3,0,0,1,12,15.5Z" />
                    <path d="M12,3.5a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0v-1A1,1,0,0,0,12,3.5Z" />
                    <path d="M12,18.5a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0v-1A1,1,0,0,0,12,18.5Z" />
                    <path d="M5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Z" />
                    <path d="M17,16.29a1,1,0,0,0,0,1.41l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41L18.36,16.29A1,1,0,0,0,17,16.29Z" />
                    <path d="M4.5,12a1,1,0,0,0-1-1H2.5a1,1,0,0,0,0,2H3.5A1,1,0,0,0,4.5,12Z" />
                    <path d="M21.5,11H20.5a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Z" />
                    <path d="M7.05,17a1,1,0,0,0-.71-.29,1,1,0,0,0-.7.29l-.71.71a1,1,0,0,0,1.41,1.41L7.05,18.36A1,1,0,0,0,7.05,17Z" />
                    <path d="M18.36,5.64a1,1,0,0,0-1.41,0l-.71.71a1,1,0,0,0,1.41,1.41l.71-.71A1,1,0,0,0,18.36,5.64Z" />
                </svg>

                {/* Moon Icon (Shows when theme is 'light', clicking switches to dark) */}
                <svg
                    className="swap-off h-8 w-8 fill-current text-slate-700"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                >
                    <path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                </svg>
            </label>
        </div>
    );
}

export default ThemeSwitcher
