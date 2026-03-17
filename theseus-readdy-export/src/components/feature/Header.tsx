import { useState, useEffect } from 'react';
import { Link, useLocation } from 'react-router-dom';

const navLinks = [
  { path: '/computer-vision', label: 'Услуги' },
  { path: '/cases', label: 'Кейсы' },
  { path: '/blog', label: 'Блог' },
];

const Header = () => {
  const [isScrolled, setIsScrolled] = useState(false);
  const [menuOpen, setMenuOpen] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const handleScroll = () => setIsScrolled(window.scrollY > 40);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  useEffect(() => { setMenuOpen(false); }, [location.pathname]);

  return (
    <header
      className={`fixed top-0 left-0 right-0 z-50 transition-all duration-500 ${
        isScrolled
          ? 'bg-[#0C0C0C]/90 backdrop-blur-xl'
          : 'bg-transparent'
      }`}
    >
      <nav className="w-full px-8 lg:px-14 py-4">
        <div className="flex items-center justify-between">

          {/* Logo — фиксированная ширина для баланса */}
          <div className="flex-1 flex items-center gap-3">
            <Link to="/" className="flex items-center gap-2.5 cursor-pointer">
              <div className="w-8 h-8 flex items-center justify-center">
                <i className="ri-brain-line text-2xl text-[#E8FF47]" />
              </div>
              <span className="font-display font-bold text-base tracking-tight text-white whitespace-nowrap">
                TheseusLab
              </span>
            </Link>
            <button
              className="hidden md:flex w-9 h-9 items-center justify-center text-white/50 hover:text-white transition-colors cursor-pointer scale-x-[-1]"
              onClick={() => setMenuOpen((v) => !v)}
              aria-label="Меню"
            >
              <i className={`${menuOpen ? 'ri-close-line' : 'ri-menu-3-line'} text-xl`} />
            </button>
          </div>

          {/* Nav — строго по центру */}
          <div className="hidden md:flex items-center gap-8">
            {navLinks.map((link) => (
              <Link
                key={link.path}
                to={link.path}
                className={`text-sm font-sans transition-colors duration-200 whitespace-nowrap cursor-pointer ${
                  location.pathname === link.path
                    ? 'text-white'
                    : 'text-white/50 hover:text-white'
                }`}
              >
                {link.label}
              </Link>
            ))}
          </div>

          {/* Right side */}
          <div className="flex-1 hidden md:flex items-center justify-end gap-5">
            <a
              href="tel:+78122408118"
              className="text-sm font-sans text-white/50 hover:text-white transition-colors whitespace-nowrap cursor-pointer"
            >
              +7 (812) 240-81-18
            </a>
            <a
              href="https://t.me/theseuslab"
              target="_blank"
              rel="nofollow noopener noreferrer"
              className="w-9 h-9 flex items-center justify-center text-white/50 hover:text-white transition-colors cursor-pointer"
            >
              <i className="ri-telegram-line text-xl" />
            </a>
            <Link
              to="/contact"
              className="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium border border-white/20 text-white/80 hover:border-white/50 hover:text-white rounded-md transition-all whitespace-nowrap cursor-pointer font-sans"
            >
              Рассчитать проект
            </Link>
          </div>

          {/* Mobile burger */}
          <button
            className="md:hidden w-8 h-8 flex items-center justify-center text-white/60 hover:text-white cursor-pointer transition-colors"
            onClick={() => setMenuOpen((v) => !v)}
          >
            <i className={`${menuOpen ? 'ri-close-line' : 'ri-menu-3-line'} text-xl`} />
          </button>
        </div>
      </nav>

      {/* Mobile menu */}
      {menuOpen && (
        <div className="md:hidden bg-[#0C0C0C]/98 backdrop-blur-xl border-t border-white/5 px-6 py-6 flex flex-col gap-5">
          {navLinks.map((link) => (
            <Link
              key={link.path}
              to={link.path}
              className={`text-sm font-sans transition-colors whitespace-nowrap cursor-pointer ${
                location.pathname === link.path ? 'text-white' : 'text-white/50 hover:text-white'
              }`}
            >
              {link.label}
            </Link>
          ))}
          <a href="tel:+78122408118" className="text-sm font-sans text-white/60 hover:text-white transition-colors">
            +7 (812) 240-81-18
          </a>
          <Link
            to="/contact"
            className="inline-flex items-center justify-center px-5 py-3 text-sm font-medium border border-white/20 text-white/80 hover:border-white/50 hover:text-white rounded-md transition-all whitespace-nowrap cursor-pointer font-sans mt-2"
          >
            Рассчитать проект
          </Link>
        </div>
      )}
    </header>
  );
};

export default Header;
