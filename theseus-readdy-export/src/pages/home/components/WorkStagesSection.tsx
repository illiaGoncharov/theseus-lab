import { useState } from 'react';

interface WorkStagesSectionProps {
  theme?: 'dark' | 'light';
}

const WorkStagesSection = ({ theme = 'dark' }: WorkStagesSectionProps) => {
  const isDark = theme === 'dark';
  const [activeStage, setActiveStage] = useState<number | null>(null);

  const stages = [
    {
      icon: 'ri-search-eye-line',
      number: '01',
      title: 'Анализ задачи',
      description: 'Изучаем бизнес-процессы, выявляем узкие места и формируем чёткие требования к AI-системе.',
      tag: 'Discovery',
      duration: '1–2 нед.',
    },
    {
      icon: 'ri-draft-line',
      number: '02',
      title: 'Проектирование',
      description: 'Разрабатываем архитектуру решения, выбираем стек технологий и согласуем прототип.',
      tag: 'Design',
      duration: '1–3 нед.',
    },
    {
      icon: 'ri-code-s-slash-line',
      number: '03',
      title: 'Разработка',
      description: 'Создаём и обучаем модели, пишем программное обеспечение и проводим тестирование.',
      tag: 'Build',
      duration: '2–8 нед.',
    },
    {
      icon: 'ri-plug-2-line',
      number: '04',
      title: 'Интеграция',
      description: 'Внедряем систему в вашу инфраструктуру, настраиваем процессы и обучаем команду.',
      tag: 'Deploy',
      duration: '1–2 нед.',
    },
    {
      icon: 'ri-shield-check-line',
      number: '05',
      title: 'Поддержка',
      description: 'Мониторим работу системы, оптимизируем производительность и развиваем функциональность.',
      tag: 'Support',
      duration: 'Ongoing',
    },
  ];

  return (
    <section className={`relative py-32 overflow-hidden ${isDark ? 'bg-dark-bg' : 'bg-light-bg'}`}>
      {/* Background decoration */}
      <div className="absolute inset-0 pointer-events-none">
        <div className={`absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[900px] h-[400px] rounded-full blur-[120px] opacity-[0.04] ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
      </div>

      <div className="max-w-[1400px] mx-auto px-6 lg:px-16 relative z-10">
        {/* Header */}
        <div className="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-20 gap-6">
          <div>
            <div className="flex items-center gap-3 mb-6">
              <div className={`w-8 h-px ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`} />
              <span className={`text-xs font-medium tracking-[0.2em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>
                Процесс
              </span>
            </div>
            <h2 className={`font-display text-5xl font-bold tracking-tight ${isDark ? 'text-white' : 'text-gray-900'}`}>
              Этапы работы
            </h2>
          </div>
          <p className={`max-w-sm text-sm font-sans leading-relaxed ${isDark ? 'text-white/40' : 'text-gray-500'}`}>
            Прозрачный процесс от первого звонка до запуска и масштабирования вашего AI-решения
          </p>
        </div>

        {/* Desktop layout */}
        <div className="hidden lg:block">
          {/* Progress line */}
          <div className="relative mb-0">
            <div className={`absolute top-[52px] left-[calc(10%+24px)] right-[calc(10%+24px)] h-px ${isDark ? 'bg-white/8' : 'bg-gray-200'}`} />
            <div
              className={`absolute top-[52px] left-[calc(10%+24px)] h-px transition-all duration-700 ${isDark ? 'bg-accent-lime' : 'bg-accent-lime-dark'}`}
              style={{
                width: activeStage !== null
                  ? `${(activeStage / (stages.length - 1)) * 100}%`
                  : '0%',
                maxWidth: 'calc(80% - 48px)',
              }}
            />
          </div>

          <div className="flex items-start justify-between gap-2">
            {stages.map((stage, index) => (
              <div
                key={index}
                className="flex-1 flex flex-col items-center text-center cursor-pointer group"
                onMouseEnter={() => setActiveStage(index)}
                onMouseLeave={() => setActiveStage(null)}
              >
                {/* Icon circle */}
                <div className={`relative w-[104px] h-[104px] flex items-center justify-center rounded-full border-2 transition-all duration-300 mb-6 ${
                  activeStage === index
                    ? isDark
                      ? 'bg-accent-lime border-accent-lime shadow-[0_0_32px_rgba(232,255,71,0.25)]'
                      : 'bg-accent-lime-dark border-accent-lime-dark shadow-[0_0_32px_rgba(184,204,0,0.25)]'
                    : isDark
                      ? 'bg-dark-card border-white/10 group-hover:border-accent-lime/40'
                      : 'bg-white border-gray-200 group-hover:border-accent-lime-dark/40'
                }`}>
                  <i className={`${stage.icon} text-2xl transition-colors duration-300 ${
                    activeStage === index
                      ? isDark ? 'text-dark-bg' : 'text-white'
                      : isDark ? 'text-white/60' : 'text-gray-500'
                  }`} />
                  {/* Number badge */}
                  <span className={`absolute -top-2 -right-2 w-6 h-6 flex items-center justify-center rounded-full text-[10px] font-bold font-display transition-all duration-300 ${
                    activeStage === index
                      ? isDark ? 'bg-dark-bg text-accent-lime' : 'bg-white text-accent-lime-dark'
                      : isDark ? 'bg-dark-muted text-white/30' : 'bg-gray-100 text-gray-400'
                  }`}>
                    {index + 1}
                  </span>
                </div>

                {/* Tag */}
                <span className={`text-[10px] font-medium tracking-[0.15em] uppercase font-sans mb-2 transition-colors duration-300 ${
                  activeStage === index
                    ? isDark ? 'text-accent-lime' : 'text-accent-lime-dark'
                    : isDark ? 'text-white/25' : 'text-gray-400'
                }`}>
                  {stage.tag}
                </span>

                {/* Title */}
                <h3 className={`font-display text-base font-semibold mb-2 transition-colors duration-300 ${
                  activeStage === index
                    ? isDark ? 'text-white' : 'text-gray-900'
                    : isDark ? 'text-white/70' : 'text-gray-700'
                }`}>
                  {stage.title}
                </h3>

                {/* Description — visible on hover */}
                <p className={`text-xs font-sans leading-relaxed transition-all duration-300 px-2 ${
                  activeStage === index
                    ? isDark ? 'text-white/55 opacity-100 max-h-24' : 'text-gray-500 opacity-100 max-h-24'
                    : 'opacity-0 max-h-0 overflow-hidden'
                }`}>
                  {stage.description}
                </p>

                {/* Duration */}
                <div className={`mt-3 px-3 py-1 rounded-full text-[10px] font-sans font-medium transition-all duration-300 ${
                  activeStage === index
                    ? isDark
                      ? 'bg-accent-lime/10 text-accent-lime border border-accent-lime/20'
                      : 'bg-accent-lime-dark/10 text-accent-lime-dark border border-accent-lime-dark/20'
                    : isDark
                      ? 'bg-transparent text-white/20 border border-white/8'
                      : 'bg-transparent text-gray-400 border border-gray-200'
                }`}>
                  {stage.duration}
                </div>
              </div>
            ))}
          </div>
        </div>

        {/* Mobile layout */}
        <div className="lg:hidden space-y-4">
          {stages.map((stage, index) => (
            <div
              key={index}
              className={`relative p-6 rounded-2xl border transition-all duration-300 ${
                isDark
                  ? 'bg-dark-card border-white/8 hover:border-accent-lime/30'
                  : 'bg-white border-gray-200 hover:border-accent-lime-dark/30'
              }`}
            >
              <div className="flex items-start gap-5">
                {/* Big number */}
                <span className={`font-display text-5xl font-bold leading-none select-none ${isDark ? 'text-white/6' : 'text-gray-100'}`}>
                  {stage.number}
                </span>
                <div className="flex-1 pt-1">
                  <div className="flex items-center gap-2 mb-2">
                    <div className={`w-8 h-8 flex items-center justify-center rounded-lg ${isDark ? 'bg-accent-lime/10' : 'bg-accent-lime-dark/10'}`}>
                      <i className={`${stage.icon} text-base ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`} />
                    </div>
                    <span className={`text-[10px] font-medium tracking-[0.15em] uppercase font-sans ${isDark ? 'text-accent-lime' : 'text-accent-lime-dark'}`}>
                      {stage.tag}
                    </span>
                    <span className={`ml-auto text-[10px] font-sans px-2 py-0.5 rounded-full border ${isDark ? 'text-white/30 border-white/10' : 'text-gray-400 border-gray-200'}`}>
                      {stage.duration}
                    </span>
                  </div>
                  <h3 className={`font-display text-lg font-semibold mb-1.5 ${isDark ? 'text-white' : 'text-gray-900'}`}>
                    {stage.title}
                  </h3>
                  <p className={`text-sm font-sans leading-relaxed ${isDark ? 'text-white/40' : 'text-gray-500'}`}>
                    {stage.description}
                  </p>
                </div>
              </div>
              {/* Connector */}
              {index < stages.length - 1 && (
                <div className={`absolute -bottom-4 left-10 w-px h-4 ${isDark ? 'bg-white/10' : 'bg-gray-200'}`} />
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default WorkStagesSection;
