import { useRef, useEffect } from 'react';
import { Link } from 'react-router-dom';

const services = [
  {
    num: '01',
    title: 'Машинное зрение',
    description: 'Системы распознавания объектов, анализа видеопотоков и мониторинга в реальном времени. Автоматизация контроля качества и безопасности на производстве.',
    tags: ['Детекция объектов', 'Видеоаналитика', 'Контроль качества'],
    icon: 'ri-eye-2-line',
    link: '/computer-vision',
    image: 'https://readdy.ai/api/search-image?query=abstract%20computer%20vision%20AI%20system%20visualization%2C%20dark%20background%20with%20geometric%20detection%20frames%20and%20bounding%20boxes%2C%20minimal%20clean%20lines%2C%20monochrome%20with%20subtle%20yellow-green%20accent%20highlights%2C%20technical%20diagram%20aesthetic%2C%20no%20people%2C%20pure%20abstract%20technology%20visualization%20with%20grid%20overlay%20and%20data%20points&width=600&height=400&seq=wwd1&orientation=landscape',
  },
  {
    num: '02',
    title: 'Речевые технологии',
    description: 'Распознавание и синтез речи, анализ тональности, голосовые интерфейсы и автоматизация коммуникаций для бизнеса.',
    tags: ['ASR / TTS', 'NLP', 'Голосовые боты'],
    icon: 'ri-mic-2-line',
    link: '/contact',
    image: 'https://readdy.ai/api/search-image?query=abstract%20sound%20wave%20visualization%20AI%20speech%20technology%2C%20dark%20background%20with%20waveform%20patterns%20and%20frequency%20spectrum%2C%20minimal%20clean%20design%2C%20monochrome%20with%20subtle%20yellow-green%20accent%20highlights%2C%20technical%20audio%20processing%20aesthetic%2C%20pure%20abstract%20technology%20visualization%20with%20oscilloscope%20patterns&width=600&height=400&seq=wwd2&orientation=landscape',
  },
  {
    num: '03',
    title: 'Автоматизация процессов',
    description: 'Интеллектуальные системы для оптимизации рабочих процессов, прогнозирования и принятия решений на основе данных.',
    tags: ['RPA', 'Предиктивная аналитика', 'Decision AI'],
    icon: 'ri-flow-chart',
    link: '/contact',
    image: 'https://readdy.ai/api/search-image?query=abstract%20data%20flow%20automation%20visualization%2C%20dark%20background%20with%20connected%20nodes%20and%20flowing%20data%20streams%2C%20minimal%20clean%20lines%2C%20monochrome%20with%20subtle%20yellow-green%20accent%20highlights%2C%20technical%20pipeline%20diagram%20aesthetic%2C%20pure%20abstract%20technology%20visualization%20with%20network%20graph%20and%20process%20nodes&width=600&height=400&seq=wwd3&orientation=landscape',
  },
];

const WhatWeDoSection = () => {
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
      { threshold: 0.1 }
    );

    const items = sectionRef.current?.querySelectorAll('.reveal-item');
    items?.forEach((item) => observer.observe(item));
    return () => observer.disconnect();
  }, []);

  return (
    <section ref={sectionRef} className="py-32 bg-dark-bg">
      <div className="max-w-[1400px] mx-auto px-6 lg:px-16">
        {/* Header */}
        <div className="reveal-item opacity-0 translate-y-8 transition-all duration-700 flex flex-col md:flex-row md:items-end justify-between gap-8 mb-20">
          <div>
            <div className="flex items-center gap-3 mb-5">
              <div className="w-6 h-px bg-accent-lime" />
              <span className="text-accent-lime text-xs font-medium tracking-[0.2em] uppercase font-sans">Что мы делаем</span>
            </div>
            <h2 className="font-display text-5xl lg:text-6xl font-bold text-white leading-tight">
              Три направления<br />
              <span className="text-white/30">нашей экспертизы</span>
            </h2>
          </div>
          <p className="text-white/40 text-base font-sans max-w-xs leading-relaxed">
            Разрабатываем AI-системы под конкретные бизнес-задачи — от прототипа до промышленного внедрения
          </p>
        </div>

        {/* Cards */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-px bg-dark-border rounded-2xl overflow-hidden">
          {services.map((s, i) => (
            <div
              key={i}
              className="reveal-item opacity-0 translate-y-8 transition-all duration-700 group bg-dark-bg hover:bg-dark-card relative overflow-hidden cursor-pointer"
              style={{ transitionDelay: `${i * 120}ms` }}
            >
              {/* Image */}
              <div className="relative h-52 overflow-hidden">
                <img
                  src={s.image}
                  alt={s.title}
                  className="w-full h-full object-cover object-top opacity-60 group-hover:opacity-80 group-hover:scale-105 transition-all duration-500"
                />
                <div className="absolute inset-0 bg-gradient-to-b from-transparent via-dark-bg/40 to-dark-bg" />
                <div className="absolute top-4 left-4 w-8 h-8 flex items-center justify-center">
                  <i className={`${s.icon} text-xl text-accent-lime`} />
                </div>
                <div className="absolute top-4 right-4 text-white/20 font-display text-xs font-bold tracking-widest">
                  {s.num}
                </div>
              </div>

              {/* Content */}
              <div className="p-8">
                <h3 className="font-display text-2xl font-bold text-white mb-3 group-hover:text-accent-lime transition-colors duration-300">
                  {s.title}
                </h3>
                <p className="text-white/40 text-sm font-sans leading-relaxed mb-6">
                  {s.description}
                </p>
                <div className="flex flex-wrap gap-2 mb-8">
                  {s.tags.map((tag, ti) => (
                    <span
                      key={ti}
                      className="px-3 py-1 text-xs font-sans text-white/40 border border-white/10 rounded-full group-hover:border-accent-lime/30 group-hover:text-accent-lime/70 transition-colors duration-300"
                    >
                      {tag}
                    </span>
                  ))}
                </div>
                <Link
                  to={s.link}
                  className="inline-flex items-center gap-2 text-sm font-sans text-white/30 group-hover:text-accent-lime transition-colors duration-300 whitespace-nowrap"
                >
                  Подробнее
                  <i className="ri-arrow-right-line w-4 h-4 flex items-center justify-center" />
                </Link>
              </div>

              {/* Bottom accent line */}
              <div className="absolute bottom-0 left-0 right-0 h-px bg-accent-lime scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left" />
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default WhatWeDoSection;
