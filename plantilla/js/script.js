document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.sidebar ul li a');
    const sections = document.querySelectorAll('.content > div');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = e.target.getAttribute('href').substring(1);

            sections.forEach(section => {
                section.style.display = 'none';
            });

            document.getElementById(target).style.display = 'block';
        });
    });

    // Mostrar el primer elemento por defecto
    document.getElementById('dashboard').style.display = 'block';
});
