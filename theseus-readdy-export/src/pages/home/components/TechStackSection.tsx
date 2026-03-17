import { useRef, useEffect } from 'react';

const technologies = [
  { name: 'Python', icon: 'ri-code-s-slash-line', category: 'Core' },
  { name: 'PyTorch', icon: 'ri-fire-line', category: 'ML' },
  { name: 'TensorFlow', icon: 'ri-brain-line', category: 'ML' },
  { name: 'OpenCV', icon: 'ri-eye-line', category: 'Vision' },
  { name: 'YOLO', icon: 'ri-focus-3-line', category: 'Vision' },
  { name: 'Yandex Speech', icon: 'ri-mic-line', category: 'Speech' },
  { name: 'Django', icon: 'ri-layout-line', category: 'Backend' },
  { name: 'Docker', icon: 'ri-ship-line', category: 'Infra' },
  { name: 'PostgreSQL', icon: 'ri-database-line', category: 'Data' },
  { name: 'Redis', icon: 'ri-database-2-line', category: 'Data' },
  { name: 'FastAPI', icon: 'ri-rocket-line', category: 'API' },
  { name: 'React', icon: 'ri-reactjs-line', category: 'UI' },
];

interface Props { theme?: 'dark' | 'light'; }

const TechStackSection = ({ theme = 'dark' }: Props) => {
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
        <div className="reveal-item opacity-0 translate-y-8 transition-all duration-700 flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-20">
          <div>
            <div className="flex items-center gap-3 mb-5">
              <div className={`w-6 h-px ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
              <span className={`text-xs font-medium tracking-[0.2em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>Технологии</span>
            </div>
            <h2 className={`font-display text-5xl lg:text-6xl font-bold leading-tight ${isDark ? 'text-white' : 'text-gray-900'}`}>
              Стек, на котором<br />
              <span className={isDark ? 'text-white/30' : 'text-gray-400'}>строятся системы</span>
            </h2>
          </div>
          <p className={`text-sm font-sans max-w-xs leading-relaxed ${isDark ? 'text-white/35' : 'text-gray-400'}`}>
            Используем проверенные инструменты и открытые стандарты для создания надёжных AI-решений
          </p>
        </div>

        <div className={`reveal-item opacity-0 translate-y-8 transition-all duration-700 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-px rounded-2xl overflow-hidden ${isDark ? 'bg-dark-border' : 'bg-light-border'}`}>
          {technologies.map((tech, i) => (
            <div
              key={i}
              className={`group transition-all duration-300 p-6 flex flex-col items-center gap-3 cursor-pointer ${
                isDark ? 'bg-dark-surface hover:bg-dark-card' : 'bg-light-surface hover:bg-light-card'
              }`}
            >
              <div className="w-10 h-10 flex items-center justify-center">
                <i className={`${tech.icon} text-2xl transition-colors duration-300 ${
                  isDark ? 'text-white/20 group-hover:text-accent-lime' : 'text-gray-300 group-hover:text-accent-lime-dark'
                }`} />
              </div>
              <span className={`font-sans text-xs font-medium transition-colors duration-300 text-center ${
                isDark ? 'text-white/30 group-hover:text-white/70' : 'text-gray-400 group-hover:text-gray-800'
              }`}>
                {tech.name}
              </span>
              <span className={`font-sans text-[10px] transition-colors duration-300 ${
                isDark ? 'text-white/15 group-hover:text-accent-lime/50' : 'text-gray-300 group-hover:text-accent-lime-dark/70'
              }`}>
                {tech.category}
              </span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default TechStackSection;