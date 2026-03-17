import { useRef, useEffect } from 'react';

const useCases = [
  {
    index: '01',
    title: 'Мониторинг безопасности',
    description: 'Автоматическое обнаружение инцидентов, несанкционированного доступа и нарушений протоколов в режиме реального времени.',
    pipeline: ['Камеры', 'AI-модель', 'Детекция событий', 'Аналитика'],
    metric: '—80%',
    metricLabel: 'инцидентов',
    image: 'https://readdy.ai/api/search-image?query=dark%20industrial%20security%20monitoring%20room%20with%20multiple%20screens%20showing%20AI%20detection%20overlays%2C%20bounding%20boxes%20around%20figures%2C%20minimal%20dark%20aesthetic%2C%20yellow-green%20accent%20highlights%20on%20detection%20frames%2C%20abstract%20technical%20visualization%2C%20no%20faces%20visible%2C%20cinematic%20dark%20atmosphere%20with%20subtle%20grid%20lines&width=900&height=560&seq=uc1&orientation=landscape',
  },
  {
    index: '02',
    title: 'Анализ производительности персонала',
    description: 'Оценка эффективности работы, выявление узких мест в процессах и оптимизация рабочих операций на основе видеоданных.',
    pipeline: ['Видеопоток', 'Обработка', 'Анализ', 'Отчёты'],
    metric: '+40%',
    metricLabel: 'эффективность',
    image: 'https://readdy.ai/api/search-image?query=abstract%20AI%20analytics%20dashboard%20visualization%20showing%20worker%20activity%20heatmaps%20and%20performance%20metrics%2C%20dark%20background%20with%20minimal%20yellow-green%20data%20overlays%2C%20technical%20diagram%20aesthetic%2C%20no%20people%20faces%2C%20clean%20geometric%20data%20visualization%20with%20flow%20lines%20and%20node%20graphs&width=900&height=560&seq=uc2&orientation=landscape',
  },
  {
    index: '03',
    title: 'Распознавание объектов и материалов',
    description: 'Идентификация и классификация объектов, контроль качества продукции и автоматизация учёта материалов.',
    pipeline: ['Сканирование', 'Детекция', 'Классификация', 'База данных'],
    metric: '95%',
    metricLabel: 'точность',
    image: 'https://readdy.ai/api/search-image?query=abstract%20computer%20vision%20object%20detection%20visualization%2C%20dark%20background%20with%20geometric%20bounding%20boxes%20and%20classification%20labels%20floating%20over%20industrial%20objects%2C%20minimal%20yellow-green%20accent%20highlights%2C%20technical%20AI%20overlay%20aesthetic%2C%20clean%20dark%20atmosphere%20with%20subtle%20grid&width=900&height=560&seq=uc3&orientation=landscape',
  },
  {
    index: '04',
    title: 'Мониторинг операционных процессов',
    description: 'Контроль соблюдения технологических процессов, предотвращение сбоев и оптимизация производственных циклов.',
    pipeline: ['Сенсоры', 'Процессинг', 'Алерты', 'Дашборд'],
    metric: '3×',
    metricLabel: 'быстрее реакция',
    image: 'https://readdy.ai/api/search-image?query=abstract%20industrial%20process%20monitoring%20visualization%2C%20dark%20background%20with%20flowing%20data%20streams%20and%20process%20pipeline%20diagram%2C%20minimal%20yellow-green%20accent%20highlights%20on%20nodes%20and%20connections%2C%20technical%20AI%20system%20aesthetic%2C%20clean%20dark%20atmosphere%20with%20subtle%20geometric%20patterns&width=900&height=560&seq=uc4&orientation=landscape',
  },
];

interface Props { theme?: 'dark' | 'light'; }

const UseCasesSection = ({ theme = 'dark' }: Props) => {
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
    <section ref={sectionRef} className={`py-32 ${isDark ? 'bg-dark-surface' : 'bg-light-surface'}`}>
      <div className="max-w-[1400px] mx-auto px-6 lg:px-16">
        <div className="reveal-item opacity-0 translate-y-8 transition-all duration-700 mb-20">
          <div className="flex items-center gap-3 mb-5">
            <div className={`w-6 h-px ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
            <span className={`text-xs font-medium tracking-[0.2em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>Сценарии применения</span>
          </div>
          <h2 className={`font-display text-5xl lg:text-6xl font-bold leading-tight ${isDark ? 'text-white' : 'text-gray-900'}`}>
            Как AI решает<br />
            <span className={isDark ? 'text-white/30' : 'text-gray-400'}>реальные задачи бизнеса</span>
          </h2>
        </div>

        <div className="space-y-4">
          {useCases.map((uc, i) => (
            <div
              key={i}
              className="reveal-item opacity-0 translate-y-8 transition-all duration-700 group"
              style={{ transitionDelay: `${i * 80}ms` }}
            >
              <div className={`border rounded-2xl overflow-hidden transition-all duration-500 cursor-pointer ${
                isDark
                  ? 'border-dark-border hover:border-white/20'
                  : 'border-light-border hover:border-gray-400'
              }`}>
                <div className="grid grid-cols-1 lg:grid-cols-[1fr_420px] gap-0">
                  <div className="p-8 lg:p-10 flex flex-col justify-between gap-8">
                    <div className="flex items-start gap-6">
                      <span className={`font-display text-xs font-bold tracking-widest mt-1 shrink-0 ${isDark ? 'text-white/15' : 'text-gray-300'}`}>{uc.index}</span>
                      <div>
                        <h3 className={`font-display text-2xl font-bold mb-3 transition-colors duration-300 ${
                          isDark ? 'text-white group-hover:text-accent-lime' : 'text-gray-900 group-hover:text-accent-lime-dark'
                        }`}>
                          {uc.title}
                        </h3>
                        <p className={`text-sm font-sans leading-relaxed max-w-lg ${isDark ? 'text-white/40' : 'text-gray-400'}`}>
                          {uc.description}
                        </p>
                      </div>
                    </div>

                    <div className="flex items-center gap-0 ml-10">
                      {uc.pipeline.map((step, si) => (
                        <div key={si} className="flex items-center">
                          <div className={`px-3 py-1.5 border rounded-lg text-xs font-sans transition-all duration-300 whitespace-nowrap ${
                            isDark
                              ? 'border-white/10 text-white/40 group-hover:border-accent-lime/25 group-hover:text-white/60'
                              : 'border-gray-200 text-gray-400 group-hover:border-accent-lime-dark/30 group-hover:text-gray-700'
                          }`}>
                            {step}
                          </div>
                          {si < uc.pipeline.length - 1 && (
                            <div className={`relative w-8 h-px mx-0.5 ${isDark ? 'bg-white/10' : 'bg-gray-200'}`}>
                              <div className={`absolute inset-0 transition-colors duration-500 ${isDark ? 'bg-accent-lime/0 group-hover:bg-accent-lime/60' : 'bg-transparent group-hover:bg-accent-lime-dark/50'}`} />
                            </div>
                          )}
                        </div>
                      ))}
                    </div>

                    <div className="ml-10">
                      <span className={`font-display text-4xl font-bold ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>{uc.metric}</span>
                      <span className={`text-sm font-sans ml-2 ${isDark ? 'text-white/30' : 'text-gray-400'}`}>{uc.metricLabel}</span>
                    </div>
                  </div>

                  <div className="relative h-56 lg:h-auto overflow-hidden">
                    <img
                      src={uc.image}
                      alt={uc.title}
                      className={`w-full h-full object-cover object-top group-hover:scale-105 transition-all duration-700 ${isDark ? 'opacity-50 group-hover:opacity-70' : 'opacity-60 group-hover:opacity-80'}`}
                    />
                    <div className={`absolute inset-0 lg:block hidden bg-gradient-to-r ${isDark ? 'from-dark-surface via-dark-surface/20 to-transparent' : 'from-light-surface via-light-surface/20 to-transparent'}`} />
                    <div className={`absolute inset-0 lg:hidden bg-gradient-to-t ${isDark ? 'from-dark-surface via-transparent to-transparent' : 'from-light-surface via-transparent to-transparent'}`} />
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default UseCasesSection;