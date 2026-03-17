import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import Header from '../../components/feature/Header';
import Footer from '../../components/feature/Footer';

const AboutPage = () => {
  const [missionRef, missionInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [approachRef, approachInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [expertiseRef, expertiseInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [workflowRef, workflowInView] = useInView({ triggerOnce: true, threshold: 0.1 });

  const approaches = [
    {
      number: '01',
      title: 'Кастомная разработка AI',
      description: 'Создаем решения под конкретные задачи бизнеса, а не адаптируем готовые продукты',
    },
    {
      number: '02',
      title: 'Интеграция с процессами',
      description: 'Встраиваем AI-системы в существующие бизнес-процессы без их нарушения',
    },
    {
      number: '03',
      title: 'Масштабируемая архитектура',
      description: 'Проектируем системы с возможностью роста и расширения функционала',
    },
    {
      number: '04',
      title: 'Непрерывная оптимизация',
      description: 'Постоянно улучшаем модели на основе реальных данных эксплуатации',
    },
  ];

  const expertise = [
    { icon: 'ri-brain-line', title: 'Искусственный интеллект', color: '#00F0FF' },
    { icon: 'ri-cpu-line', title: 'Машинное обучение', color: '#8B5CF6' },
    { icon: 'ri-eye-line', title: 'Компьютерное зрение', color: '#3B82F6' },
    { icon: 'ri-database-line', title: 'Data Engineering', color: '#10B981' },
  ];

  const workflow = [
    { icon: 'ri-database-2-line', label: 'Сбор данных', description: 'Анализ и подготовка данных' },
    { icon: 'ri-settings-3-line', label: 'Обучение модели', description: 'Разработка и тренировка AI' },
    { icon: 'ri-plug-line', label: 'Интеграция системы', description: 'Внедрение в инфраструктуру' },
    { icon: 'ri-rocket-line', label: 'Развертывание', description: 'Запуск в продакшн' },
    { icon: 'ri-line-chart-line', label: 'Мониторинг', description: 'Контроль и оптимизация' },
  ];

  return (
    <div className="min-h-screen bg-dark-bg">
      <Header />
      
      <main className="pt-20">
        <section className="py-24 bg-gradient-to-br from-dark-bg via-dark-surface to-dark-bg">
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.6 }}
              className="text-center"
            >
              <h1 className="text-5xl lg:text-6xl font-bold text-white mb-6">
                О компании
              </h1>
              <p className="text-xl text-slate-400 max-w-3xl mx-auto leading-relaxed">
                Мы создаем интеллектуальные системы, которые решают реальные операционные задачи бизнеса
              </p>
            </motion.div>
          </div>
        </section>

        <section className="py-24 bg-dark-surface" ref={missionRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={missionInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center max-w-5xl mx-auto"
            >
              <h2 className="text-4xl lg:text-5xl font-bold text-white mb-8 leading-tight">
                Наша миссия — создавать практичные AI-системы, которые решают реальные операционные проблемы
              </h2>
              <p className="text-xl text-slate-400 leading-relaxed">
                Мы фокусируемся на разработке интеллектуальных решений, которые приносят измеримую ценность бизнесу: автоматизируют процессы, повышают эффективность и снижают операционные риски
              </p>
            </motion.div>
          </div>
        </section>

        <section className="py-24 bg-dark-bg" ref={approachRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={approachInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h2 className="text-5xl font-bold text-white mb-4">
                Наш подход
              </h2>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
              {approaches.map((approach, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, y: 30 }}
                  animate={approachInView ? { opacity: 1, y: 0 } : {}}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  className="relative"
                >
                  <div className="text-7xl font-bold text-accent-cyan/10 mb-4">
                    {approach.number}
                  </div>
                  <h3 className="text-xl font-bold text-white mb-3">
                    {approach.title}
                  </h3>
                  <p className="text-slate-400 leading-relaxed">
                    {approach.description}
                  </p>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        <section className="py-24 bg-dark-surface" ref={expertiseRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={expertiseInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h2 className="text-5xl font-bold text-white mb-4">
                Экспертиза
              </h2>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
              {expertise.map((item, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, scale: 0.8 }}
                  animate={expertiseInView ? { opacity: 1, scale: 1 } : {}}
                  transition={{ duration: 0.4, delay: index * 0.1 }}
                  className="bg-gradient-to-br from-dark-card to-dark-surface border border-dark-border rounded-2xl p-8 hover:border-accent-cyan/50 hover:-translate-y-2 transition-all cursor-pointer"
                >
                  <div
                    className="w-16 h-16 rounded-xl flex items-center justify-center mb-6"
                    style={{
                      background: `linear-gradient(135deg, ${item.color}20, ${item.color}10)`,
                    }}
                  >
                    <i
                      className={`${item.icon} text-4xl w-10 h-10 flex items-center justify-center`}
                      style={{ color: item.color }}
                    ></i>
                  </div>
                  <h3 className="text-xl font-bold text-white">
                    {item.title}
                  </h3>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        <section className="py-24 bg-dark-bg" ref={workflowRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={workflowInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h2 className="text-5xl font-bold text-white mb-4">
                Процесс разработки
              </h2>
              <p className="text-xl text-slate-400">
                От идеи до работающей системы
              </p>
            </motion.div>

            <div className="max-w-5xl mx-auto">
              <div className="flex flex-col md:flex-row items-center justify-between gap-6">
                {workflow.map((step, index) => (
                  <div key={index} className="flex items-center">
                    <motion.div
                      initial={{ opacity: 0, scale: 0.8 }}
                      animate={workflowInView ? { opacity: 1, scale: 1 } : {}}
                      transition={{ duration: 0.4, delay: index * 0.15 }}
                      className="flex flex-col items-center text-center"
                    >
                      <div className="w-24 h-24 rounded-2xl bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 border border-accent-cyan/30 flex items-center justify-center mb-4 hover:scale-110 transition-transform cursor-pointer">
                        <i className={`${step.icon} text-4xl text-accent-cyan w-12 h-12 flex items-center justify-center`}></i>
                      </div>
                      <h3 className="text-lg font-bold text-white mb-2">
                        {step.label}
                      </h3>
                      <p className="text-sm text-slate-400 max-w-[140px]">
                        {step.description}
                      </p>
                    </motion.div>
                    {index < workflow.length - 1 && (
                      <div className="hidden md:block w-12 h-0.5 bg-gradient-to-r from-accent-cyan to-accent-purple mx-4" />
                    )}
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
};

export default AboutPage;