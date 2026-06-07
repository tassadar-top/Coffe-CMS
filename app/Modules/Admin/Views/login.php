<section class="admin-card stack">
    <div>
        <p class="meta">Protected admin access</p>
        <h1>Sign in</h1>
    </div>
    <form class="stack" method="post" action="<?= base_url($adminPath . '/login'); ?>">
        <input type="hidden" name="<?= \App\Core\Security::escape($csrfKey); ?>" value="<?= \App\Core\Security::escape($csrf); ?>">
        <label>
            Username
            <input type="text" name="username" required>
        </label>
        <label>
            Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Sign in</button>
    </form>
</section>
