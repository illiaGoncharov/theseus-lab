import { motion } from 'framer-motion';
import { useInView } from 'react-intersection-observer';
import Header from '../../components/feature/Header';
import Footer from '../../components/feature/Footer';

const BlogPage = () => {
  const [ref, inView] = useInView({ triggerOnce: true, threshold: 0.1 });

  const articles = [
    {
      category: 'Компьютерное зрение',
      title: 'Как работают современные системы детекции объектов',
      description: 'Разбираем архитектуру YOLO и других популярных моделей компьютерного зрения',
      date: '15 января 2025',
      image: 'https://readdy.ai/api/search-image?query=futuristic%20AI%20computer%20vision%20neural%20network%20visualization%20with%20glowing%20nodes%20and%20connections%2C%20object%20detection%20bounding%20boxes%20overlay%2C%20deep%20learning%20architecture%20diagram%20with%20cyan%20and%20purple%20accents%2C%20dark%20tech%20background%20with%20digital%20mesh%20patterns%2C%20modern%20AI%20technology%20illustration&width=760&height=440&seq=blog1&orientation=landscape',
    },
    {
      category: 'AI автоматизация',
      title: 'Внедрение AI в производственные процессы',
      description: 'Практические советы по интеграции систем искусственного интеллекта на производстве',
      date: '12 января 2025',
      image: 'https://readdy.ai/api/search-image?query=industrial%20AI%20automation%20system%20with%20robotic%20arms%20and%20smart%20sensors%2C%20futuristic%20factory%20floor%20with%20glowing%20blue%20data%20streams%2C%20neural%20network%20overlay%20on%20manufacturing%20equipment%2C%20dark%20industrial%20environment%20with%20cyan%20accent%20lighting%2C%20modern%20production%20line%20with%20AI%20analytics&width=760&height=440&seq=blog2&orientation=landscape',
    },
    {
      category: 'Кейсы',
      title: 'Автоматизация контроля качества: опыт внедрения',
      description: 'Реальный кейс внедрения системы компьютерного зрения на производственной линии',
      date: '10 января 2025',
      image: 'https://readdy.ai/api/search-image?query=quality%20control%20AI%20system%20detecting%20defects%20on%20products%2C%20automated%20inspection%20with%20computer%20vision%2C%20glowing%20cyan%20detection%20boxes%20highlighting%20product%20flaws%2C%20dark%20industrial%20setting%20with%20blue%20accent%20lights%2C%20futuristic%20quality%20assurance%20technology%20with%20neural%20network%20visualization&width=760&height=440&seq=blog3&orientation=landscape',
    },
    {
      category: 'Технологии',
      title: 'PyTorch vs TensorFlow: выбор фреймворка для CV',
      description: 'Сравнение популярных фреймворков для разработки систем компьютерного зрения',
      date: '8 января 2025',
      image: 'https://readdy.ai/api/search-image?query=AI%20framework%20comparison%20visualization%20with%20neural%20network%20architectures%2C%20PyTorch%20and%20TensorFlow%20logos%20in%20futuristic%20style%2C%20glowing%20code%20snippets%20and%20data%20flow%20diagrams%2C%20dark%20tech%20background%20with%20cyan%20and%20purple%20gradients%2C%20modern%20deep%20learning%20development%20environment&width=760&height=440&seq=blog4&orientation=landscape',
    },
    {
      category: 'Индустрия',
      title: 'AI в логистике: тренды 2025 года',
      description: 'Обзор ключевых направлений применения искусственного интеллекта в логистике',
      date: '5 января 2025',
      image: 'https://readdy.ai/api/search-image?query=futuristic%20logistics%20warehouse%20with%20AI%20tracking%20systems%2C%20autonomous%20robots%20and%20smart%20inventory%20management%2C%20glowing%20cyan%20data%20visualization%20overlays%2C%20dark%20warehouse%20interior%20with%20blue%20accent%20lighting%2C%20neural%20network%20monitoring%20supply%20chain%20operations%2C%20modern%20automated%20distribution%20center&width=760&height=440&seq=blog5&orientation=landscape',
    },
    {
      category: 'AI Engineering',
      title: 'Оптимизация производительности AI-моделей',
      description: 'Методы ускорения инференса и снижения потребления ресурсов',
      date: '3 января 2025',
      image: 'https://readdy.ai/api/search-image?query=AI%20model%20optimization%20visualization%20with%20performance%20metrics%2C%20neural%20network%20compression%20and%20acceleration%20diagrams%2C%20glowing%20cyan%20graphs%20showing%20speed%20improvements%2C%20dark%20tech%20background%20with%20digital%20patterns%2C%20futuristic%20machine%20learning%20optimization%20interface%20with%20purple%20accents&width=760&height=440&seq=blog6&orientation=landscape',
    },
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
                Блог
              </h1>
              <p className="text-xl text-slate-400 max-w-3xl mx-auto">
                Статьи о технологиях искусственного интеллекта, компьютерном зрении и практиках AI-разработки
              </p>
            </motion.div>
          </div>
        </section>

        <section className="py-24 bg-dark-bg" ref={ref}>
          <div className="max-w-[1400px] mx-auto px-6 lg:px-12">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {articles.map((article, index) => (
                <motion.article
                  key={index}
                  initial={{ opacity: 0, y: 50 }}
                  animate={inView ? { opacity: 1, y: 0 } : {}}
                  transition={{ duration: 0.6, delay: index * 0.1 }}
                  className="group bg-dark-card rounded-2xl overflow-hidden border border-dark-border hover:border-accent-cyan/50 hover:-translate-y-2 hover:shadow-2xl hover:shadow-accent-cyan/20 transition-all duration-300 cursor-pointer"
                >
                  <div className="relative h-56 overflow-hidden">
                    <img
                      src={article.image}
                      alt={article.title}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-dark-card to-transparent" />
                  </div>

                  <div className="p-6 space-y-4">
                    <span className="inline-block px-3 py-1 bg-accent-cyan/20 text-accent-cyan text-xs font-medium rounded-full border border-accent-cyan/30">
                      {article.category}
                    </span>

                    <h2 className="text-xl font-bold text-white leading-tight line-clamp-2 group-hover:text-accent-cyan transition-colors">
                      {article.title}
                    </h2>

                    <p className="text-slate-400 line-clamp-2">
                      {article.description}
                    </p>

                    <div className="pt-4 border-t border-dark-border flex items-center justify-between">
                      <span className="text-sm text-slate-500">
                        {article.date}
                      </span>
                      <div className="flex items-center text-accent-cyan text-sm font-medium group-hover:translate-x-2 transition-transform">
                        Читать
                        <i className="ri-arrow-right-line ml-1 w-4 h-4 flex items-center justify-center"></i>
                      </div>
                    </div>
                  </div>
                </motion.article>
              ))}
            </div>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
};

export default BlogPage;