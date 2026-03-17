import { Link } from 'react-router-dom';

interface Props { theme?: 'dark' | 'light'; }

const Footer = ({ theme = 'dark' }: Props) => {
  const isDark = theme === 'dark';

  return (
    <footer className={`border-t transition-colors duration-500 ${isDark ? 'bg-dark-bg border-white/6' : 'bg-light-bg border-gray-200'}`}>
      <div className="max-w-[1400px] mx-auto px-6 lg:px-16 py-16">
        <div className="grid grid-cols-1 md:grid-cols-[2fr_1fr_1fr_1fr] gap-12 mb-16">
          <div>
            <div className="flex items-center gap-3 mb-5">
              <div className="w-9 h-9 flex items-center justify-center">
                <i className={`ri-brain-line text-2xl ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`} />
              </div>
              <span className={`font-display font-bold text-lg tracking-tight ${isDark ? 'text-white' : 'text-gray-900'}`}>
                TheseusLab
              </span>
            </div>
            <p className={`text-sm font-sans leading-relaxed max-w-xs ${isDark ? 'text-white/30' : 'text-gray-400'}`}>
              Разработка интеллектуальных систем для анализа данных и автоматизации бизнес-процессов
            </p>
          </div>

          <div>
            <h4 className={`text-xs font-sans font-medium tracking-[0.15em] uppercase mb-5 ${isDark ? 'text-white/60' : 'text-gray-400'}`}>Решения</h4>
            <ul className="space-y-3">
              {[
                { to: '/computer-vision', label: 'Компьютерное зрение' },
                { to: '/computer-vision/security', label: 'Системы безопасности' },
                { to: '/computer-vision/staff-performance', label: 'Анализ персонала' },
                { to: '/computer-vision/object-recognition', label: 'Распознавание объектов' },
              ].map((item) => (
                <li key={item.to}>
                  <Link to={item.to} className={`text-sm font-sans transition-colors cursor-pointer ${isDark ? 'text-white/30 hover:text-white' : 'text-gray-400 hover:text-gray-900'}`}>
                    {item.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className={`text-xs font-sans font-medium tracking-[0.15em] uppercase mb-5 ${isDark ? 'text-white/60' : 'text-gray-400'}`}>Компания</h4>
            <ul className="space-y-3">
              {[
                { to: '/cases', label: 'Кейсы' },
                { to: '/about', label: 'О нас' },
                { to: '/blog', label: 'Блог' },
                { to: '/contact', label: 'Контакты' },
              ].map((item) => (
                <li key={item.to}>
                  <Link to={item.to} className={`text-sm font-sans transition-colors cursor-pointer ${isDark ? 'text-white/30 hover:text-white' : 'text-gray-400 hover:text-gray-900'}`}>
                    {item.label}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className={`text-xs font-sans font-medium tracking-[0.15em] uppercase mb-5 ${isDark ? 'text-white/60' : 'text-gray-400'}`}>Контакты</h4>
            <ul className="space-y-3">
              <li className={`flex items-center gap-2 text-sm font-sans ${isDark ? 'text-white/30' : 'text-gray-400'}`}>
                <i className={`ri-mail-line w-4 h-4 flex items-center justify-center text-sm ${isDark ? 'text-accent-lime/60' : 'text-accent-lime-dark/70'}`} />
                info@theseuslab.ru
              </li>
              <li className={`flex items-center gap-2 text-sm font-sans ${isDark ? 'text-white/30' : 'text-gray-400'}`}>
                <i className={`ri-phone-line w-4 h-4 flex items-center justify-center text-sm ${isDark ? 'text-accent-lime/60' : 'text-accent-lime-dark/70'}`} />
                +7 (812) 240-81-18
              </li>
            </ul>
            <div className="flex items-center gap-4 mt-6">
              {[
                { icon: 'ri-telegram-line', href: '#' },
                { icon: 'ri-youtube-line', href: '#' },
              ].map((s, i) => (
                <a
                  key={i}
                  href={s.href}
                  className={`w-8 h-8 flex items-center justify-center border rounded-lg transition-all cursor-pointer ${
                    isDark
                      ? 'border-white/8 text-white/25 hover:text-accent-lime hover:border-accent-lime/30'
                      : 'border-gray-200 text-gray-300 hover:text-accent-lime-dark hover:border-accent-lime-dark/40'
                  }`}
                >
                  <i className={`${s.icon} text-sm`} />
                </a>
              ))}
            </div>
          </div>
        </div>

        <div className={`pt-8 border-t flex flex-col md:flex-row justify-between items-center gap-4 ${isDark ? 'border-white/6' : 'border-gray-100'}`}>
          <p className={`text-xs font-sans ${isDark ? 'text-white/20' : 'text-gray-400'}`}>
            © 2025 TheseusLab. Все права защищены.
          </p>
          <div className="flex items-center gap-6">
            <Link to="/cookies" className={`text-xs font-sans transition-colors cursor-pointer ${isDark ? 'text-white/20 hover:text-white/40' : 'text-gray-400 hover:text-gray-600'}`}>
              Политика cookies
            </Link>
            <Link to="/terms" className={`text-xs font-sans transition-colors cursor-pointer ${isDark ? 'text-white/20 hover:text-white/40' : 'text-gray-400 hover:text-gray-600'}`}>
              Пользовательское соглашение
            </Link>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;