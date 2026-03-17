import { Link } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import Header from '../../components/feature/Header';
import Footer from '../../components/feature/Footer';

interface SubcategoryPageProps {
  category: 'security' | 'staff-performance' | 'object-recognition';
}

const SubcategoryPage = ({ category }: SubcategoryPageProps) => {
  const [problemRef, problemInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [solutionRef, solutionInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [capabilitiesRef, capabilitiesInView] = useInView({ triggerOnce: true, threshold: 0.1 });
  const [industriesRef, industriesInView] = useInView({ triggerOnce: true, threshold: 0.1 });

  const content = {
    security: {
      title: 'Системы безопасности',
      hero: 'Автоматический мониторинг безопасности с использованием компьютерного зрения',
      problems: [
        'Инциденты не обнаруживаются своевременно',
        'Отсутствие круглосуточного мониторинга всех зон',
        'Ручной контроль требует больших ресурсов',
        'Пропуск критических событий из-за человеческого фактора',
      ],
      solutionText: 'Система компьютерного зрения анализирует видеопотоки в режиме реального времени, автоматически обнаруживает подозрительную активность, несанкционированный доступ и нарушения протоколов безопасности. AI-модели обучены распознавать различные типы инцидентов и мгновенно отправлять уведомления.',
      capabilities: [
        { icon: 'ri-user-search-line', title: 'Обнаружение объектов', description: 'Распознавание людей, транспорта и объектов' },
        { icon: 'ri-route-line', title: 'Анализ поведения', description: 'Выявление подозрительных действий и паттернов' },
        { icon: 'ri-alarm-warning-line', title: 'Детекция событий', description: 'Автоматические алерты при инцидентах' },
        { icon: 'ri-time-line', title: 'Мониторинг 24/7', description: 'Непрерывный контроль всех зон' },
        { icon: 'ri-dashboard-line', title: 'Аналитика', description: 'Отчеты и статистика по инцидентам' },
        { icon: 'ri-map-pin-line', title: 'Зонирование', description: 'Контроль доступа в ограниченные зоны' },
      ],
      industries: [
        { name: 'Склады', icon: 'ri-building-line' },
        { name: 'Производство', icon: 'ri-factory-line' },
        { name: 'Ритейл', icon: 'ri-store-line' },
        { name: 'Строительство', icon: 'ri-hammer-line' },
        { name: 'Офисы', icon: 'ri-community-line' },
      ],
    },
    'staff-performance': {
      title: 'Анализ производительности персонала',
      hero: 'Оценка эффективности работы и оптимизация процессов',
      problems: [
        'Отсутствие объективных данных о производительности',
        'Сложность выявления узких мест в процессах',
        'Невозможность отслеживать соблюдение стандартов работы',
        'Ручной учет времени и операций неэффективен',
      ],
      solutionText: 'AI-система анализирует видеопотоки рабочих процессов, отслеживает выполнение операций, измеряет время выполнения задач и выявляет отклонения от стандартов. Система предоставляет объективные данные для оптимизации процессов и повышения эффективности.',
      capabilities: [
        { icon: 'ri-time-line', title: 'Учет времени', description: 'Автоматический хронометраж операций' },
        { icon: 'ri-bar-chart-line', title: 'Анализ эффективности', description: 'Оценка производительности сотрудников' },
        { icon: 'ri-alert-line', title: 'Выявление отклонений', description: 'Обнаружение нарушений стандартов' },
        { icon: 'ri-line-chart-line', title: 'Мониторинг KPI', description: 'Отслеживание ключевых показателей' },
        { icon: 'ri-file-chart-line', title: 'Отчетность', description: 'Детальные отчеты по производительности' },
        { icon: 'ri-lightbulb-line', title: 'Рекомендации', description: 'Предложения по оптимизации' },
      ],
      industries: [
        { name: 'Склады', icon: 'ri-building-line' },
        { name: 'Производство', icon: 'ri-factory-line' },
        { name: 'Ритейл', icon: 'ri-store-line' },
        { name: 'Логистика', icon: 'ri-truck-line' },
        { name: 'Колл-центры', icon: 'ri-customer-service-line' },
      ],
    },
    'object-recognition': {
      title: 'Распознавание объектов и материалов',
      hero: 'Автоматическая идентификация и классификация объектов',
      problems: [
        'Ручная идентификация объектов занимает много времени',
        'Высокая вероятность ошибок при визуальном контроле',
        'Сложность учета большого количества объектов',
        'Отсутствие автоматизации контроля качества',
      ],
      solutionText: 'Система компьютерного зрения автоматически распознает и классифицирует объекты, материалы и продукцию. AI-модели обучены определять типы объектов, их характеристики, дефекты и соответствие стандартам качества.',
      capabilities: [
        { icon: 'ri-focus-3-line', title: 'Детекция объектов', description: 'Обнаружение и локализация объектов' },
        { icon: 'ri-price-tag-3-line', title: 'Классификация', description: 'Определение типа и категории объектов' },
        { icon: 'ri-checkbox-circle-line', title: 'Контроль качества', description: 'Выявление дефектов и несоответствий' },
        { icon: 'ri-ruler-line', title: 'Измерения', description: 'Определение размеров и параметров' },
        { icon: 'ri-database-line', title: 'Учет и инвентаризация', description: 'Автоматический подсчет объектов' },
        { icon: 'ri-search-eye-line', title: 'Поиск объектов', description: 'Быстрый поиск по визуальным признакам' },
      ],
      industries: [
        { name: 'Производство', icon: 'ri-factory-line' },
        { name: 'Склады', icon: 'ri-building-line' },
        { name: 'Ритейл', icon: 'ri-store-line' },
        { name: 'Логистика', icon: 'ri-truck-line' },
        { name: 'Сельское хозяйство', icon: 'ri-plant-line' },
      ],
    },
  };

  const currentContent = content[category];

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
              className="text-center max-w-4xl mx-auto"
            >
              <h1 className="text-5xl lg:text-6xl font-bold text-white mb-6">
                {currentContent.title}
              </h1>
              <p className="text-xl text-slate-400 leading-relaxed">
                {currentContent.hero}
              </p>
            </motion.div>
          </div>
        </section>

        <section className="py-24 bg-dark-surface" ref={problemRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={problemInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="max-w-4xl mx-auto"
            >
              <div className="flex items-start space-x-6 mb-8">
                <div className="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500/20 to-orange-500/20 flex items-center justify-center flex-shrink-0">
                  <i className="ri-error-warning-line text-4xl text-red-500 w-10 h-10 flex items-center justify-center"></i>
                </div>
                <div>
                  <h2 className="text-4xl font-bold text-white mb-6">Проблема</h2>
                  <div className="space-y-4">
                    {currentContent.problems.map((problem, index) => (
                      <div key={index} className="flex items-start space-x-3">
                        <i className="ri-alert-line text-red-500 mt-1 w-5 h-5 flex items-center justify-center flex-shrink-0"></i>
                        <p className="text-lg text-slate-400">{problem}</p>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            </motion.div>
          </div>
        </section>

        <section className="py-24 bg-dark-bg" ref={solutionRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
              <motion.div
                initial={{ opacity: 0, x: -50 }}
                animate={solutionInView ? { opacity: 1, x: 0 } : {}}
                transition={{ duration: 0.6 }}
              >
                <h2 className="text-4xl font-bold text-white mb-6">Решение</h2>
                <p className="text-lg text-slate-400 leading-relaxed">
                  {currentContent.solutionText}
                </p>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, x: 50 }}
                animate={solutionInView ? { opacity: 1, x: 0 } : {}}
                transition={{ duration: 0.6 }}
                className="grid grid-cols-2 gap-4"
              >
                {[
                  { icon: 'ri-camera-line', label: 'Видеопоток' },
                  { icon: 'ri-brain-line', label: 'AI обработка' },
                  { icon: 'ri-checkbox-circle-line', label: 'Детекция' },
                  { icon: 'ri-dashboard-line', label: 'Аналитика' },
                ].map((item, index) => (
                  <div
                    key={index}
                    className="bg-gradient-to-br from-dark-card to-dark-surface border border-dark-border rounded-2xl p-6 hover:border-accent-cyan/50 transition-all cursor-pointer"
                  >
                    <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center mb-3">
                      <i className={`${item.icon} text-2xl text-accent-cyan w-8 h-8 flex items-center justify-center`}></i>
                    </div>
                    <h3 className="text-white font-semibold">{item.label}</h3>
                  </div>
                ))}
              </motion.div>
            </div>
          </div>
        </section>

        <section className="py-24 bg-dark-surface" ref={capabilitiesRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={capabilitiesInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h2 className="text-5xl font-bold text-white mb-4">
                Возможности системы
              </h2>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {currentContent.capabilities.map((capability, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, y: 30 }}
                  animate={capabilitiesInView ? { opacity: 1, y: 0 } : {}}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  className="bg-gradient-to-br from-dark-card to-dark-surface border border-dark-border rounded-2xl p-6 hover:border-accent-cyan/50 hover:-translate-y-1 transition-all cursor-pointer"
                >
                  <div className="w-12 h-12 rounded-xl bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center mb-4">
                    <i className={`${capability.icon} text-2xl text-accent-cyan w-8 h-8 flex items-center justify-center`}></i>
                  </div>
                  <h3 className="text-xl font-bold text-white mb-2">
                    {capability.title}
                  </h3>
                  <p className="text-slate-400">
                    {capability.description}
                  </p>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        <section className="py-24 bg-dark-bg" ref={industriesRef}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <motion.div
              initial={{ opacity: 0, y: 30 }}
              animate={industriesInView ? { opacity: 1, y: 0 } : {}}
              transition={{ duration: 0.6 }}
              className="text-center mb-16"
            >
              <h2 className="text-5xl font-bold text-white mb-4">
                Индустрии
              </h2>
              <p className="text-xl text-slate-400">
                Отрасли, где применяется решение
              </p>
            </motion.div>

            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
              {currentContent.industries.map((industry, index) => (
                <motion.div
                  key={index}
                  initial={{ opacity: 0, scale: 0.8 }}
                  animate={industriesInView ? { opacity: 1, scale: 1 } : {}}
                  transition={{ duration: 0.4, delay: index * 0.1 }}
                  className="bg-gradient-to-br from-dark-card to-dark-surface border border-dark-border rounded-2xl p-6 hover:border-accent-cyan/50 hover:-translate-y-2 transition-all cursor-pointer"
                >
                  <div className="flex flex-col items-center text-center space-y-4">
                    <div className="w-16 h-16 rounded-xl bg-gradient-to-br from-accent-cyan/20 to-accent-purple/20 flex items-center justify-center">
                      <i className={`${industry.icon} text-3xl text-accent-cyan w-10 h-10 flex items-center justify-center`}></i>
                    </div>
                    <span className="text-white font-medium">{industry.name}</span>
                  </div>
                </motion.div>
              ))}
            </div>
          </div>
        </section>

        <section className="py-24 bg-dark-surface">
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <div className="text-center space-y-8">
              <h2 className="text-5xl font-bold text-white">
                Обсудите внедрение
              </h2>
              <p className="text-xl text-slate-400 max-w-2xl mx-auto">
                Расскажите о вашей задаче, и мы предложим оптимальное решение
              </p>
              <Link
                to="/contact"
                className="inline-block px-12 py-5 bg-gradient-to-r from-accent-cyan to-accent-purple text-white text-lg font-semibold rounded-full hover:shadow-2xl hover:shadow-accent-cyan/50 hover:scale-105 transition-all whitespace-nowrap cursor-pointer"
              >
                Связаться с нами
              </Link>
            </div>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
};

export default SubcategoryPage;