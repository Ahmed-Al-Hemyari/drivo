import { usePage } from '@inertiajs/react';

export function useTrans() {
    const { translations } = usePage().props as any;

    // A simple function that accepts a key and returns the translated text
    const __ = (key: string): string => {
        return translations[key] || key;
    };

    return { __ };
}
