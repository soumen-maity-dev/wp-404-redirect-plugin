# LS 404 Redirect to Home — WordPress Plugin  
A lightweight WordPress plugin that automatically redirects all 404 (Not Found) pages to the homepage.  
Useful for websites that want to avoid broken pages or maintain a controlled user flow.

> Important: Blanket 404 redirects *may* affect SEO. Use only if you understand the implications.

---

## 🚀 Features
- Redirect all 404 pages to the homepage  
- Uses `wp_safe_redirect()` for security  
- SEO-safe with loop detection  
- Allows custom status codes (301 or 302)  
- No settings page needed — activate and done  
- Clean and lightweight OOP-based code  
- Does not run during admin, AJAX, or REST API requests  

---

## 🧠 How It Works
The plugin hooks into WordPress's `template_redirect` action and checks if the requested page is a 404.  
If yes, it redirects the visitor to the home URL using a safe, sanitized redirect.

### Example: Change redirect status to 302
Add this to your theme or another plugin:

```php
add_filter( 'ls_404_redirect_status_code', function() {
    return 302;
} );
