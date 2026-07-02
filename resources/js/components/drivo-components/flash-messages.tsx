import { usePage } from '@inertiajs/react';
import React, { useEffect, useState } from 'react';

const FlashMessages: React.FC = () => {
  const { flash } = usePage().props as any;
  const [visible, setVisible] = useState(false);
  const [message, setMessage] = useState<{ type: 'success' | 'error' | 'info'; text: string } | null>(null);

  useEffect(() => {
    // Check if any flash message keys exist in the current page props
    if (flash?.success) {
      /* eslint-disable react-hooks/set-state-in-effect */
      setMessage({ type: 'success', text: flash.success });
      setVisible(true);
      /* eslint-enable react-hooks/set-state-in-effect */
    } else if (flash?.error) {
       
      setMessage({ type: 'error', text: flash.error });
      setVisible(true);
       
    } else if (flash?.info) {
       
      setMessage({ type: 'info', text: flash.info });
      setVisible(true);
       
    }

    // Automatically fade out the notification banner after 4 seconds
    const timer = setTimeout(() => setVisible(false), 4000);

    return () => clearTimeout(timer);
  }, [flash]);

  if (!visible || !message) {
return null;
}

  return (
    <div className="toast toast-top toast-end z-50 mt-16 p-4 animate-in fade-in slide-in-from-top-4 duration-300">
      <div className={`alert rounded-2xl shadow-lg border-none text-white font-bold gap-3 py-3 px-5 ${
        message.type === 'success' ? 'bg-success' :
        message.type === 'error' ? 'bg-error' : 'bg-info'
      }`}>
        {message.type === 'success' && <i className="fa-solid fa-circle-check text-lg"></i>}
        {message.type === 'error' && <i className="fa-solid fa-circle-exclamation text-lg"></i>}
        {message.type === 'info' && <i className="fa-solid fa-circle-info text-lg"></i>}

        <span className="text-sm">{message.text}</span>

        <button onClick={() => setVisible(false)} className="btn btn-ghost btn-xs circle text-white/70 hover:text-white">
          <i className="fa-solid fa-xmark"></i>
        </button>
      </div>
    </div>
  );
};

export default FlashMessages;
