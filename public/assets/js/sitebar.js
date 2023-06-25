document.querySelectorAll('ul.nav > li > a').forEach((nav) => {
    console.log({
        navPathname: nav.pathname,
        windowLocationPathname: window.location.pathname,
        areEqual: nav.pathname === window.location.pathname,
    });
    if (nav.pathname === window.location.pathname) {
        nav.closest('a').classList.add('active')
    } else {
        nav.closest('a').classList.remove('active')
    }
})