import React from 'react';
import { Link, usePage } from '@inertiajs/react';
import { useTrans } from '@/helpers/useTrans';
import { LinkItem } from '@/types/types';

interface PaginationProps {
  links: LinkItem[];
}

export function Pagination({ links }: PaginationProps) {
  const { locale } = usePage().props;
  const { __ } = useTrans();

  // If there's only 1 page, hide it completely
  if (!links || links.length <= 3) return null;

  const cleanLabel = (label: string) => {
    if (label.includes('Previous')) return __('Previous');
    if (label.includes('Next')) return __('Next');
    return label;
  };

  return (
    <div className="flex justify-center my-10 w-full" data-theme="light">
      <div className="join border border-gray-200 shadow-sm">
        {links.map((link, index) => {
          const isLabelString = link.label.includes('Previous') || link.label.includes('Next');

          if (!link.url) {
            return (
              <button
                key={index}
                disabled
                className="join-item btn btn-md btn-ghost text-gray-400 no-animation cursor-not-allowed"
                dangerouslySetInnerHTML={{ __html: cleanLabel(link.label) }}
              />
            );
          }

          return (
            <Link
              key={index}
              href={link.url}
              preserveScroll
              className={`join-item btn btn-md ${
                link.active
                  ? 'btn-primary bg-(--color-primary-color) border-(--color-primary-color) text-white font-bold'
                  : 'btn-ghost text-gray-700 hover:bg-base-200'
              }`}
            >
              {/* If it's HTML code entity like &laquo;, decode it safely, otherwise print string */}
              {isLabelString ? (
                <span dangerouslySetInnerHTML={{ __html: cleanLabel(link.label) }} />
              ) : (
                cleanLabel(link.label)
              )}
            </Link>
          );
        })}
      </div>
    </div>
  );
}
