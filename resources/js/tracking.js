/**
 * Amtech EV Tracking JS
 * Handles dataLayer pushes for Google Ads Conversions & GTM
 */

window.dataLayer = window.dataLayer || [];

const tracking = {
    pushEvent: function(eventName, eventParams = {}) {
        const payload = {
            'event': eventName,
            'page_location': window.location.href,
            'timestamp': new Date().toISOString(),
            ...eventParams
        };

        window.dataLayer.push(payload);

        if (typeof window.gtag === 'function') {
            window.gtag('event', eventName, eventParams);
        }

        if (!import.meta.env.PROD) {
            console.log('[Amtech Tracking Event]', eventName, payload);
        }
    },

    trackGoogleAdsConversion: function(sendToLabel, value = 0, currency = 'MYR') {
        if (typeof window.gtag === 'function') {
            window.gtag('event', 'conversion', {
                'send_to': sendToLabel,
                'value': value,
                'currency': currency
            });
            if (!import.meta.env.PROD) {
                console.log('[Amtech Google Ads Conversion Sent]', sendToLabel, { value, currency });
            }
        }
    },

    initWhatsAppTracking: function() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && (link.href.includes('wa.me') || link.href.includes('whatsapp.com') || link.href.includes('api.whatsapp.com'))) {
                this.pushEvent('whatsapp_click', {
                    'link_url': link.href,
                    'link_text': (link.innerText || link.getAttribute('title') || 'WhatsApp Button').trim(),
                    'event_category': 'Engagement',
                    'event_label': 'WhatsApp Contact'
                });
            }
        });
    },

    initPhoneTracking: function() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href.startsWith('tel:')) {
                this.pushEvent('phone_click', {
                    'phone_number': link.href.replace('tel:', ''),
                    'event_category': 'Engagement',
                    'event_label': 'Phone Call'
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
export default tracking;

