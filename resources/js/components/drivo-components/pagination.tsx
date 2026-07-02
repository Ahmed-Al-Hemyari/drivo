import { Link } from '@inertiajs/react';
import React from 'react';
import { useTrans } from '@/helpers/useTrans';
import type { LinkItem } from '@/types/types';

interface PaginationProps {
  links: LinkItem[];
}

export function Pagination({ links }: PaginationProps) {
  const { __ } = useTrans();

  if (!links || links.length <= 3) {
return null;
}

  const cleanLabel = (label: string) => {
    if (label.includes('Previous')) {
return __('Previous');
}

    if (label.includes('Next')) {
return __('Next');
}

    return label;
  };

  return (
    <div className="flex justify-center my-10 w-full">
      <div className="join border border-base-300 shadow-sm bg-base-100">
        {links.map((link, index) => {
          const isLabelString = link.label.includes('Previous') || link.label.includes('Next');

          if (!link.url) {
            return (
              <button
                key={index}
                disabled
                className="join-item btn btn-md btn-ghost text-base-content/40 cursor-not-allowed"
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
                  ? 'btn-primary bg-(--color-primary-color) border-(--color-primary-color) text-white'
                  : 'btn-ghost text-base-content/80 hover:bg-base-200'
              }`}
            >
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
