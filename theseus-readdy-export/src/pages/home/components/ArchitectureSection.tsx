import { useRef, useEffect } from 'react';

const layers = [
  {
    num: '01',
    title: 'Источники данных',
    desc: 'Камеры, сенсоры, внешние API и потоковые данные',
    tags: ['Камеры', 'Сенсоры', 'API', 'Стримы'],
    icon: 'ri-database-2-line',
  },
  {
    num: '02',
    title: 'Модели компьютерного зрения',
    desc: 'Предобученные и кастомные нейросети для детекции и классификации',
    tags: ['YOLO', 'ResNet', 'Custom CNN', 'Transformer'],
    icon: 'ri-brain-line',
  },
  {
    num: '03',
    title: 'Слой обработки',
    desc: 'Предобработка, извлечение признаков и инференс в реальном времени',
    tags: ['Preprocessing', 'Feature Extraction', 'Inference'],
    icon: 'ri-cpu-line',
  },
  {
    num: '04',
    title: 'Бизнес-логика',
    desc: 'Правила, принятие решений и система оповещений',
    tags: ['Rules Engine', 'Decision Making', 'Alerts'],
    icon: 'ri-git-branch-line',
  },
  {
    num: '05',
    title: 'Аналитический дашборд',
    desc: 'Визуализация данных, отчёты и мониторинг в реальном времени',
    tags: ['Визуализация', 'Отчёты', 'Мониторинг'],
    icon: 'ri-dashboard-line',
  },
];

interface Props { theme?: 'dark' | 'light'; }

const ArchitectureSection = ({ theme = 'dark' }: Props) => {
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
              <span className={`text-xs font-medium tracking-[0.2em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>Архитектура</span>
            </div>
            <h2 className={`font-display text-5xl lg:text-6xl font-bold leading-tight ${isDark ? 'text-white' : 'text-gray-900'}`}>
              Как устроена<br />
              <span className={isDark ? 'text-white/30' : 'text-gray-400'}>AI-система</span>
            </h2>
          </div>
          <p className={`text-sm font-sans max-w-xs leading-relaxed ${isDark ? 'text-white/35' : 'text-gray-400'}`}>
            Каждый слой системы решает конкретную задачу — от сбора данных до принятия решений
          </p>
        </div>

        <div className="reveal-item opacity-0 translate-y-8 transition-all duration-700">
          {/* Desktop */}
          <div className="hidden lg:flex items-stretch gap-0">
            {layers.map((layer, i) => (
              <div key={i} className="flex items-stretch flex-1">
                <div className={`group flex-1 border rounded-2xl p-6 transition-all duration-400 cursor-pointer flex flex-col gap-4 ${
                  isDark
                    ? 'border-dark-border hover:border-accent-lime/30 bg-dark-card hover:bg-dark-surface'
                    : 'border-light-border hover:border-accent-lime-dark/40 bg-light-card hover:bg-light-surface'
                }`}>
                  <div className="flex items-center justify-between">
                    <span className={`font-display text-xs font-bold tracking-widest ${isDark ? 'text-white/15' : 'text-gray-300'}`}>{layer.num}</span>
                    <div className="w-8 h-8 flex items-center justify-center">
                      <i className={`${layer.icon} text-lg transition-colors duration-300 ${
                        isDark ? 'text-white/25 group-hover:text-accent-lime' : 'text-gray-300 group-hover:text-accent-lime-dark'
                      }`} />
                    </div>
                  </div>
                  <h3 className={`font-display text-base font-bold leading-snug transition-colors duration-300 ${
                    isDark ? 'text-white group-hover:text-accent-lime' : 'text-gray-900 group-hover:text-accent-lime-dark'
                  }`}>
                    {layer.title}
                  </h3>
                  <p className={`text-xs font-sans leading-relaxed flex-1 ${isDark ? 'text-white/30' : 'text-gray-400'}`}>
                    {layer.desc}
                  </p>
                  <div className="flex flex-wrap gap-1.5">
                    {layer.tags.map((tag, ti) => (
                      <span key={ti} className={`px-2 py-0.5 text-xs font-sans rounded-md transition-all duration-300 ${
                        isDark
                          ? 'text-white/30 border border-white/8 group-hover:border-accent-lime/20 group-hover:text-white/50'
                          : 'text-gray-400 border border-gray-200 group-hover:border-accent-lime-dark/30 group-hover:text-gray-700'
                      }`}>
                        {tag}
                      </span>
                    ))}
                  </div>
                </div>
                {i < layers.length - 1 && (
                  <div className="flex items-center px-2 shrink-0">
                    <i className={`ri-arrow-right-s-line text-xs w-3 h-3 flex items-center justify-center ${isDark ? 'text-white/15' : 'text-gray-300'}`} />
                  </div>
                )}
              </div>
            ))}
          </div>

          {/* Mobile */}
          <div className="lg:hidden space-y-3">
            {layers.map((layer, i) => (
              <div key={i}>
                <div className={`group border rounded-xl p-5 transition-all duration-300 cursor-pointer ${
                  isDark
                    ? 'border-dark-border hover:border-accent-lime/30 bg-dark-card'
                    : 'border-light-border hover:border-accent-lime-dark/40 bg-light-card'
                }`}>
                  <div className="flex items-start gap-4">
                    <div className="w-8 h-8 flex items-center justify-center shrink-0 mt-0.5">
                      <i className={`${layer.icon} text-lg transition-colors duration-300 ${
                        isDark ? 'text-white/25 group-hover:text-accent-lime' : 'text-gray-300 group-hover:text-accent-lime-dark'
                      }`} />
                    </div>
                    <div className="flex-1">
                      <div className="flex items-center gap-2 mb-1">
                        <span className={`font-display text-xs font-bold tracking-widest ${isDark ? 'text-white/15' : 'text-gray-300'}`}>{layer.num}</span>
                        <h3 className={`font-display text-sm font-bold transition-colors duration-300 ${
                          isDark ? 'text-white group-hover:text-accent-lime' : 'text-gray-900 group-hover:text-accent-lime-dark'
                        }`}>
                          {layer.title}
                        </h3>
                      </div>
                      <p className={`text-xs font-sans leading-relaxed ${isDark ? 'text-white/30' : 'text-gray-400'}`}>{layer.desc}</p>
                    </div>
                  </div>
                </div>
                {i < layers.length - 1 && (
                  <div className="flex justify-center py-1">
                    <i className={`ri-arrow-down-s-line w-4 h-4 flex items-center justify-center ${isDark ? 'text-white/15' : 'text-gray-300'}`} />
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </div>
    </section>
  );
};

export default ArchitectureSection;