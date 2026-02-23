# View components

Reusable Blade components used across the app. Use these instead of duplicating markup.

## UI components (`x-ui.*`)

| Component | Use |
|-----------|-----|
| **page-container** | Wraps dashboard page content (py-12, max-w-7xl, spacing). |
| **card** | White/dark panel with rounded corners and shadow. Add `class="p-6"` etc. as needed. |
| **section-header** | Row with title (h3) and optional action. Use `<x-slot name="action">` for the button. |
| **empty-state** | Centered empty state: optional **icon** slot, **title**, **description**, optional **action** slot. |
| **session-alert** | Flash message. Use `type="success"` or `type="error"` (reads `session('success')` / `session('error')`). |
| **button** | Button or link. Props: `tag` (button|a), `variant` (primary|secondary|danger|ghost|link-primary|link-danger), `type` (submit|button). Use `variant="secondary"` for Cancel, `variant="link-primary"` / `variant="link-danger"` for text-style Edit/Delete. |
| **action-link** | Text link. `variant="primary"` (blue), `danger`, `success`. Use for “Edit”, “View transactions”, etc. |
| **simple-modal** | Vanilla-JS modal (no Alpine). Props: `id`, `title`. Toggle with `classList.add/remove('hidden')`. |

## Form components (`x-form.*`)

| Component | Use |
|-----------|-----|
| **input** | id, name?, label?, type, value?, placeholder?, step?; supports old() and errors. |
| **input-label** | Standalone label (e.g. for custom fields). Pass `for="id"` and slot or `value`. |
| **input-error** | Renders validation errors. `:messages="$errors->get('name')"`. |
| **select** | id, name?, label?; options in slot. |
| **textarea** | id, name?, label?, value?, rows. |
| **field** | Optional wrapper: label + slot (input) + error. Props: label, id, error. |

## Layout / nav

- **dashboard-layout** – Dashboard shell (navbar + header slot + main).
- **navigation.auth-navbar** / **guest-navbar** – Nav bars.
- **modal** – Alpine-based modal (x-data, open/close events). Use **simple-modal** for vanilla JS.

## Examples

```blade
<x-ui.page-container>
    <x-ui.session-alert type="success" />
    <x-ui.section-header title="Your Accounts">
        <x-slot name="action">
            <x-ui.button type="button" onclick="...">+ Add Account</x-ui.button>
        </x-slot>
    </x-ui.section-header>
    <x-ui.card class="p-6">...</x-ui.card>
</x-ui.page-container>
```
