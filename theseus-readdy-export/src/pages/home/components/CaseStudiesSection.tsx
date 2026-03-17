import { useRef, useEffect } from 'react';
import { Link } from 'react-router-dom';

const cases = [
  {
    industry: 'Производство',
    title: 'Автоматизация контроля качества',
    challenge: 'Ручной контроль занимал много времени и приводил к пропуску дефектов',
    result: '95%',
    resultLabel: 'точность обнаружения дефектов',
    image: 'https://readdy.ai/api/search-image?query=dark%20industrial%20manufacturing%20facility%20with%20AI%20computer%20vision%20detection%20system%2C%20minimal%20dark%20aesthetic%20with%20subtle%20yellow-green%20bounding%20box%20overlays%20on%20products%2C%20abstract%20technical%20visualization%2C%20cinematic%20dark%20atmosphere%2C%20no%20faces%2C%20clean%20geometric%20detection%20frames%20on%20conveyor%20belt%20items%2C%20monochrome%20with%20lime%20accent%20highlights&width=800&height=520&seq=cs1new&orientation=landscape',
  },
  {
    industry: 'Логистика',
    title: 'Мониторинг безопасности склада',
    challenge: 'Невозможность отслеживать все зоны и своевременно реагировать на инциденты',
    result: '80%',
    resultLabel: 'сокращение инцидентов',
    image: 'https://readdy.ai/api/search-image?query=dark%20warehouse%20interior%20with%20AI%20surveillance%20system%20visualization%2C%20minimal%20dark%20aesthetic%20with%20subtle%20yellow-green%20zone%20detection%20overlays%2C%20abstract%20security%20monitoring%20dashboard%2C%20cinematic%20dark%20atmosphere%2C%20no%20faces%20visible%2C%20clean%20geometric%20detection%20zones%20and%20movement%20tracking%20lines%2C%20monochrome%20with%20lime%20accent%20highlights&width=800&height=520&seq=cs2new&orientation=landscape',
  },
  {
    industry: 'Ритейл',
    title: 'Анализ поведения покупателей',
    challenge: 'Отсутствие данных о движении покупателей и эффективности выкладки',
    result: '35%',
    resultLabel: 'рост конверсии',
    image: 'https://readdy.ai/api/search-image?query=abstract%20retail%20store%20heatmap%20visualization%20with%20AI%20customer%20flow%20analysis%2C%20dark%20background%20with%20minimal%20yellow-green%20trajectory%20lines%20and%20zone%20highlights%2C%20technical%20data%20overlay%20aesthetic%2C%20no%20people%20faces%2C%20clean%20geometric%20path%20visualization%20and%20analytics%20dashboard%20elements%2C%20monochrome%20with%20lime%20accent%20highlights&width=800&height=520&seq=cs3new&orientation=landscape',
  },
  {
    industry: 'Строительство',
    title: 'Контроль техники безопасности',
    challenge: 'Сложность контроля использования СИЗ на большой стройплощадке',
    result: '90%',
    resultLabel: 'соблюдение требований',
    image: 'https://readdy.ai/api/search-image?query=dark%20construction%20site%20with%20AI%20safety%20compliance%20monitoring%20visualization%2C%20minimal%20dark%20aesthetic%20with%20subtle%20yellow-green%20PPE%20detection%20overlays%20and%20compliance%20indicators%2C%20abstract%20technical%20visualization%2C%20cinematic%20dark%20atmosphere%2C%20no%20faces%2C%20clean%20geometric%20detection%20frames%20and%20safety%20zone%20markers%2C%20monochrome%20with%20lime%20accent%20highlights&width=800&height=520&seq=cs4new&orientation=landscape',
  },
];

interface Props { theme?: 'dark' | 'light'; }

const CaseStudiesSection = ({ theme = 'dark' }: Props) => {
  const isDark = theme === 'dark';
  const sectionRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('opacity-100', 'translate-y-0');
            entry.target.classList.remove('opacity-0', 'translate-y-8');
          }
        });
      },
      { threshold: 0.08 }
    );
    const items = sectionRef.current?.querySelectorAll('.reveal-item');
    items?.forEach((item) => observer.observe(item));
    return () => observer.disconnect();
  }, []);

  return (
    <section ref={sectionRef} className={`py-32 ${isDark ? 'bg-dark-bg' : 'bg-light-bg'}`}>
      <div className="max-w-[1400px] mx-auto px-6 lg:px-16">
        <div className="reveal-item opacity-0 translate-y-8 transition-all duration-700 flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-20">
          <div>
            <div className="flex items-center gap-3 mb-5">
              <div className={`w-6 h-px ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
              <span className={`text-xs font-medium tracking-[0.2em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>Кейсы</span>
            </div>
            <h2 className={`font-display text-5xl lg:text-6xl font-bold leading-tight ${isDark ? 'text-white' : 'text-gray-900'}`}>
              Реальные внедрения<br />
              <span className={isDark ? 'text-white/30' : 'text-gray-400'}>с измеримым результатом</span>
            </h2>
          </div>
          <Link
            to="/contact"
            className={`inline-flex items-center gap-2 text-sm font-sans transition-colors duration-300 whitespace-nowrap self-end cursor-pointer ${
              isDark ? 'text-white/40 hover:text-accent-lime' : 'text-gray-400 hover:text-accent-lime-dark'
            }`}
          >
            Обсудить ваш проект
            <i className="ri-arrow-right-line w-4 h-4 flex items-center justify-center" />
          </Link>
        </div>

        <div className={`grid grid-cols-1 md:grid-cols-2 gap-px rounded-2xl overflow-hidden ${isDark ? 'bg-dark-border' : 'bg-light-border'}`}>
          {cases.slice(0, 2).map((c, i) => (
            <div
              key={i}
              className={`reveal-item opacity-0 translate-y-8 transition-all duration-700 group cursor-pointer relative overflow-hidden ${
                isDark ? 'bg-dark-bg hover:bg-dark-card' : 'bg-light-bg hover:bg-light-card'
              }`}
              style={{ transitionDelay: `${i * 80}ms` }}
            >
              <div className="relative h-56 overflow-hidden">
                <img
                  src={c.image}
                  alt={c.title}
                  className={`w-full h-full object-cover object-top group-hover:scale-105 transition-all duration-700 ${
                    isDark ? 'opacity-50 group-hover:opacity-70' : 'opacity-60 group-hover:opacity-80'
                  }`}
                />
                <div className={`absolute inset-0 bg-gradient-to-t ${isDark ? 'from-dark-bg via-dark-bg/40 to-transparent' : 'from-light-bg via-light-bg/40 to-transparent'}`} />
                <div className="absolute top-4 left-4">
                  <span className={`px-3 py-1 text-xs font-sans font-medium rounded-full backdrop-blur-sm border ${
                    isDark
                      ? 'text-white/50 border-white/10 bg-dark-bg/60'
                      : 'text-gray-500 border-gray-200 bg-white/70'
                  }`}>
                    {c.industry}
                  </span>
                </div>
              </div>

              <div className="p-8">
                <h3 className={`font-display text-xl font-bold mb-2 transition-colors duration-300 ${
                  isDark ? 'text-white group-hover:text-accent-lime' : 'text-gray-900 group-hover:text-accent-lime-dark'
                }`}>
                  {c.title}
                </h3>
                <p className={`text-sm font-sans leading-relaxed mb-6 ${isDark ? 'text-white/35' : 'text-gray-400'}`}>
                  {c.challenge}
                </p>
                <div className={`flex items-baseline gap-2 pt-5 border-t ${isDark ? 'border-white/6' : 'border-gray-100'}`}>
                  <span className={`font-display text-4xl font-bold ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>{c.result}</span>
                  <span className={`text-xs font-sans ${isDark ? 'text-white/30' : 'text-gray-400'}`}>{c.resultLabel}</span>
                </div>
              </div>

              <div className={`absolute bottom-0 left-0 right-0 h-px scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default CaseStudiesSection;