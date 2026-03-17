import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import Header from '../../components/feature/Header';
import Footer from '../../components/feature/Footer';

const CategoryPage = () => {
  const [heroRef, heroInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [subcatRef, subcatInView] = useInView({ triggerOnce: true, threshold: 0.1 });

  const pipeline = [
    { icon: 'ri-video-line', label: 'Видеопоток', description: 'Захват данных с камер' },
    { icon: 'ri-brain-line', label: 'AI модель детекции', description: 'Обработка нейросетью' },
    { icon: 'ri-alarm-warning-line', label: 'Распознавание событий', description: 'Анализ и классификация' },
    { icon: 'ri-dashboard-line', label: 'Аналитический дашборд', description: 'Визуализация результатов' },
  ];

  const subcategories = [
    {
      title: 'Безопасность',
      description: 'Автоматическое обнаружение инцидентов, несанкционированного доступа и нарушений протоколов безопасности',
      icon: 'ri-shield-check-line',
      link: '/computer-vision/security',
      gradient: 'from-red-500 to-orange-500',
    },
    {
      title: 'Анализ производительности персонала',
      description: 'Оценка эффективности работы сотрудников и оптимизация рабочих процессов',
      icon: 'ri-team-line',
      link: '/computer-vision/staff-performance',
      gradient: 'from-accent-blue to-accent-purple',
    },
    {
      title: 'Распознавание объектов и материалов',
      description: 'Идентификация и классификация объектов, контроль качества продукции',
      icon: 'ri-focus-3-line',
      link: '/computer-vision/object-recognition',
      gradient: 'from-accent-cyan to-accent-blue',
    },
  ];

  return (
    <div className="min-h-screen bg-dark-bg">
      <Header />
      
      <main className="pt-20">
        <section className="py-24 bg-gradient-to-br from-dark-bg via-dark-surface to-dark-bg" ref={heroRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
              <motion.div
                initial={{ opacity: 0, x: -50 }}
                animate={heroInView ? { opacity: 1, x: 0 } : {}}
                transition={{ duration: 0.6 }}
                className="space-y-6"
              >
                <h1 className="text-5xl lg:text-6xl font-bold text-white leading-tight">
                  Системы{' '}
                  <span className="bg-gradient-to-r from-accent-cyan to-accent-purple bg-clip-text text-transparent">
                    компьютерного зрения
                  </span>{' '}
                  для автоматизации бизнеса
                </h1>
                
                <p className="text-lg text-slate-400 leading-relaxed">
                  Разрабатываем интеллектуальные системы для анализа визуальных данных, автоматизации контроля и мониторинга бизнес-процессов в режиме реального времени
                </p>

                <Link
                  to="/contact"
                  className="inline-block px-8 py-4 bg-gradient-to-r from-accent-cyan to-accent-purple text-white text-lg font-semibold rounded-full hover:shadow-2xl hover:shadow-accent-cyan/50 hover:scale-105 transition-all whitespace-nowrap cursor-pointer"
                >
                  Обсудить проект
                </Link>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, x: 50 }}
                animate={heroInView ? { opacity: 1, x: 0 } : {}}
                transition={{ duration: 0.6 }}
                className="space-y-6"
              >
                {pipeline.map((step, index) => (
                  <div key={index}>
                    <div className="bg-gradient-to-r from-dark-card to-dark-surface border border-dark-border rounded-2xl p-6 hover:border-accent-cyan/50 transition-all group cursor-pointer">
                      <div className="flex items-center space-x-4">
                        <div className="w-16 h-16 rounded-xl bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                          <i className={`${step.icon} text-3xl text-accent-cyan w-10 h-10 flex items-center justify-center`}></i>
                        </div>
                        <div className="flex-1">
                          <h3 className="text-lg font-bold text-white mb-1">
                            {step.label}
                          </h3>
                          <p className="text-sm text-slate-400">
                            {step.description}
                          </p>
                        </div>
                      </div>
                    </div>
                    {index < pipeline.length - 1 && (
                      <div className="flex justify-center my-3">
                        <div className="w-0.5 h-6 bg-gradient-to-b from-accent-cyan to-accent-purple" />
                      </div>
                    )}
                  </div>
                ))}
              </motion.div>
            </div>
          </div>
        </section>

        <section className="py-24 bg-dark-surface" ref={subcatRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={subcatInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h2 className="text-5xl font-bold text-white mb-4">
                Направления применения
              </h2>
              <p className="text-xl text-slate-400 max-w-3xl mx-auto">
                Выберите область для детального изучения возможностей
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              {subcategories.map((subcat, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, y: 50 }}
                  animate={subcatInView ? { opacity: 1, y: 0 } : {}}
                  transition={{ duration: 0.6, delay: index * 0.2 }}
                >
                  <Link
                    to={subcat.link}
                    className="block group h-[360px] bg-gradient-to-br from-dark-card to-dark-surface rounded-3xl p-8 border border-dark-border hover:border-accent-cyan/50 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent-cyan/20 transition-all duration-300 cursor-pointer"
                  >
                    <div className="h-full flex flex-col">
                      <div className={`w-20 h-20 rounded-2xl bg-gradient-to-br ${subcat.gradient} flex items-center justify-center mb-6 group-hover:scale-110 transition-transform`}>
                        <i className={`${subcat.icon} text-4xl text-white w-12 h-12 flex items-center justify-center`}></i>
                      </div>

                      <h3 className="text-2xl font-bold text-white mb-4">
                        {subcat.title}
                      </h3>

                      <p className="text-slate-400 leading-relaxed mb-6 flex-1">
                        {subcat.description}
                      </p>

                      <div className="flex items-center text-accent-cyan font-medium group-hover:translate-x-2 transition-transform">
                        Подробнее
                        <i className="ri-arrow-right-line ml-2 w-5 h-5 flex items-center justify-center"></i>
                      </div>
                    </div>
                  </Link>
                </motion.div>
              ))}
            </div>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
};

export default CategoryPage;