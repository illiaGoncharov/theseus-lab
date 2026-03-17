import Header from '../../components/feature/Header';
import Footer from '../../components/feature/Footer';
import HeroSection from './components/HeroSection';
import WhatWeDoSection from './components/WhatWeDoSection';
import UseCasesSection from './components/UseCasesSection';
import WorkStagesSection from './components/WorkStagesSection';
import TechStackSection from './components/TechStackSection';
import CaseStudiesSection from './components/CaseStudiesSection';
import CTASection from './components/CTASection';

const HomePage = () => {
  return (
    <div className="min-h-screen bg-dark-bg">
      <Header theme="dark" />

      <main>
        <HeroSection theme="dark" />
        <WhatWeDoSection theme="dark" />
        <UseCasesSection theme="dark" />
        <WorkStagesSection theme="dark" />
        <TechStackSection theme="dark" />
        <CaseStudiesSection theme="dark" />
        <CTASection theme="dark" />
      </main>
      <Footer theme="dark" />
    </div>
  );
};

export default HomePage;