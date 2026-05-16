/**
 * Amtech EV Tracking JS
 * Handles dataLayer pushes for Google Ads Conversions
 */

window.dataLayer = window.dataLayer || [];

const tracking = {
    pushEvent: function(eventName, eventParams = {}) {
        window.dataLayer.push({
            'event': eventName,
            ...eventParams
        });
        if (process.env.NODE_ENV !== 'production') {
            console.log('Tracking Event:', eventName, eventParams);
        }
    },

    initWhatsAppTracking: function() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && (link.href.includes('wa.me') || link.href.includes('whatsapp.com'))) {
                this.pushEvent('whatsapp_click', {
                    'link_url': link.href,
                    'link_text': link.innerText.trim() || 'WhatsApp Button'
                });
            }
        });
    },

    initPhoneTracking: function() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href.startsWith('tel:')) {
                this.pushEvent('phone_click', {
                    'phone_number': link.href.replace('tel:', '')
                });
            }
        });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    tracking.initWhatsAppTracking();
    tracking.initPhoneTracking();
});

window.amtechTracking = tracking;
